<?php

namespace RServices\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use RServices\Helpers\Button\ButtonBuilder;
use RServices\Models\Model;
use RServices\User;

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
        parent::boot();
        Router::macro('crud', function ($model) {
            $name = sprintf('%s.%s', 'manage', strtolower(basename($model)));
            \Route::prefix(Str::kebab(Str::plural(basename($model))))->group(function () use ($model, $name) {
                \Route::get('/', fn() => viewDataTables(\route(sprintf('%s.list', $name)), array_keys($model::$dataTablesFields), array_values($model::$dataTablesFields), $model::getDataTablesButtons()))->name("$name.view");
                \Route::get('/list', fn() => $model::datatables()
                    ->addColumn('action', fn($entry) => ButtonBuilder::create()
                        ->addEdit(\route(sprintf('%s.edit', $name), compact('entry')))
                        ->addDelete(\route(sprintf('%s.delete', $name), compact('entry')))
                        ->make())
                    ->make())->name("$name.list");
                \Route::get('/create', fn(Request $request) => $model::createForm(\route(sprintf('%s.create', $name))))->name("$name.create");
                \Route::post('/create', function (Request $request) use ($model, $name) {
                    if (array_key_exists('password', $request->all()))
                        if ($model == User::class) $request->offsetSet('password', \Hash::make($request->all()['password']));
                        else $request->offsetSet('password', encrypt($request->all()['password']));
                        dd($request->all());
                    ($entry = new $model($request->all()))->save();
                    return respond()->addMessage($entry->createdMessage(), 'success')->setRedirect(\route(sprintf('%s.edit', $name), compact('entry')))->response();
                })->name("$name.create");
                \Route::prefix('{entry}')->group(function () use ($model, $name) {
                    \Route::get('/edit', fn(Request $request, $entry) => $model::findOrFail($entry)->updateForm(\route(sprintf('%s.update', $name), compact('entry'))))->name("$name.edit");
                    \Route::post('/update', function (Request $request, $entry) use ($model) {
                        $entry = $model::findOrFail($entry);
                        $entry->update($request->all());
                        return respond()->addMessage($entry->updatedMessage(), 'success')->response();
                    })->name("$name.update");
                    \Route::get('/delete', function (Request $request, $entry) use ($model) {
                        $entry = $model::findOrFail($entry);
                        $entry->delete();
                        return respond()->addMessage($entry->deletedMessage(), 'success')->response();
                    })->name("$name.delete");
                });
            });
        });
        Router::macro('profile', function () {
            \Route::get('/profile', fn() => user()->updateForm(\route('manage.profile.update')))->name("manage.profile.view");
            \Route::post('/profile', function (Request $request) {
                \user()->update($request->all());
                return respond()->addMessage('Profile was successfuly saved.', 'success')->response();
            })->name("manage.profile.update");
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAuthWeb('manage', '\Manage');
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
