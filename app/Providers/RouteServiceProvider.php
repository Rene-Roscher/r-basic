<?php

namespace RServices\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use RServices\Helpers\Crud\FormContractBuilder;
use RServices\Http\Controllers\Crud\CrudController;
use RServices\Models\User;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'RServices\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/manage';

    public function boot()
    {
        Router::macro('crud', function ($model, $withPermission = true) {
            $name = sprintf('%s.%s', 'manage', $crudName = strtolower(getRealFileName($model)));
            \Route::prefix(Str::kebab(Str::plural(getRealFileName($model))))->group(function () use ($model, $name, $withPermission, $crudName) {
                $middleware = sprintf('permission:%s', $crudName);
                \Route::get('/', fn() => viewDataTables(\route(sprintf('%s.list', $name)), array_keys($model::$dataTablesFields), array_values($model::$dataTablesFields), $model::getTableViewButtons()))
                    ->middleware($withPermission ? "$middleware.list" : [])->name("$name.view");

                \Route::get('/list', fn() => $model::toDataTables($model, $name))
                    ->middleware($withPermission ? "$middleware.list" : [])->name("$name.list");

                \Route::get('/create', fn(Request $request) => $model::createForm(\route(sprintf('%s.create', $name))))
                    ->middleware($withPermission ? "$middleware.create" : [])->name("$name.create");

                \Route::post('/create', function (Request $request) use ($model, $name) {
                    if (array_key_exists('password', $request->all()))
                        if ($model == User::class) $request->offsetSet('password', \Hash::make($request->all()['password']));
                        else $request->offsetSet('password', encrypt($request->all()['password']));
                    ($entry = new $model($request->all()))->save();
                    return respond()->addMessage($entry->createdMessage(), 'success')->setRedirect(\route(sprintf('%s.edit', $name), compact('entry')))->response();
                })->middleware($withPermission ? "$middleware.create" : [])->middleware('throttle')->name("$name.create");

                \Route::prefix('{entry}')->group(function () use ($model, $name, $withPermission, $middleware) {
                    \Route::get('/edit', fn(Request $request, $entry) => $model::findOrFail($entry)->updateForm(\route(sprintf('%s.update', $name), compact('entry'))))
                        ->middleware($withPermission ? "$middleware.show" : [])->name("$name.edit");

                    \Route::post('/update', function (Request $request, $entry) use ($model) {
                        $entry = $model::findOrFail($entry);
                        $entry->update($request->all());
                        return respond()->addMessage($entry->updatedMessage(), 'success')->response();
                    })->middleware($withPermission ? "$middleware.edit" : [])->middleware('throttle')->name("$name.update");

                    \Route::get('/delete', function (Request $request, $entry) use ($model) {
                        $entry = $model::findOrFail($entry);
                        $entry->delete();
                        return respond()->addMessage($entry->deletedMessage(), 'success')->response();
                    })->middleware($withPermission ? "$middleware.delete" : [])->name("$name.delete");
                });
            });
            Route::prefix('user/{entry}')->group(function () {
                Route::get('signInto', [CrudController::class, 'signInto'])->middleware("permission:user.signinto")->name('manage.user.signInto');
            });
            Route::get('signBack', [CrudController::class, 'signBack'])->name('manage.user.signBack');
        });
        Router::macro('profile', function () {
            \Route::get('/profile', fn() => FormContractBuilder::create()->addFromArray(User::$profileFormFields, \user(), \route('manage.profile.update'), __('Save')))->name('manage.profile.view');
            \Route::post('/profile', function (Request $request) {
                $data = $request->toArray();
                if (array_key_exists('password', $data) && !empty($data['password'])) {
                    if (strlen($data['password']) < 8)
                        respond()->addMessage('The password should be at least 8 characters', 'error')->response();
                    $data['password'] = \Hash::make($data['password']);
                } else $data = \Arr::except($data, 'password');
                \user()->updateProfile($data);
                return respond()->addMessage('Profile was successfuly saved.', 'success')->response();
            })->middleware('throttle')->name("manage.profile.update");
        });
		Router::macro('passwordReset', function () {
            Route::post('/', function () {
                if (cache()->has($key = "user_password_reset_".\user()->id))
                    return respond()->addMessage(trans('auth.password_reset_throttle'), 'error')->response();
                \user()->sendRequestedPasswordResetNotification();
                cache()->put($key, now(), now()->add(config('auth.password_reset_throttle')));
                return respond()->addMessage(trans('auth.password_reset_send'), 'success')->response();
            })->name('manage.password.reset');
        });
		parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAuthWeb('manage', '\Manage');

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapAuthWeb($prefix, $namespace = '')
    {
        Route::prefix($prefix)
            ->middleware(['web', 'auth'])
            ->namespace($this->namespace.$namespace)
            ->group(base_path("routes/${prefix}.php"));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
