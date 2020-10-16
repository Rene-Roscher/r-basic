<?php

namespace RServices\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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
            \Route::prefix(Str::kebab(Str::plural(basename($model))))->name($name = sprintf('%s.%s.', 'manage', strtolower(basename($model))))->group(function () use ($model, $name) {
                \Route::get('/', fn() => viewDataTables(\route(sprintf('%slist', $name)), array_keys($model::$dataTablesFields), array_values($model::$dataTablesFields)));
                \Route::get('/list', fn() => $model::datatables()
                    ->addColumn('action', fn($entry) => ButtonBuilder::create()
                        ->addEdit(\route(sprintf('%sedit', $name), compact('entry')))->make())
                    ->make())->name('list');
                \Route::get('/create', fn(Request $request) => $model::createForm(\route(sprintf('%screate', $name))))->name('create');
                \Route::post('/create', function (Request $request) use ($model, $name) {
                    if (array_key_exists('password', $request->all()))
                        if ($model instanceof User)
                            $request->all()['password'] = \Hash::make($request->all()['password']);
                        else $request->all()['password'] = encrypt($request->all()['password']);
                    ($entry = new $model($request->all()))->save();
                    return respond()->addMessage($entry->createdMessage(), 'success')->setRedirect(\route(sprintf('%sshow', $name), compact('entry')))->response();
                })->name('create');
                \Route::prefix('{entry}')->group(function () use ($model, $name) {
                    \Route::get('/edit', fn(Request $request, $entry) => $model::findOrFail($entry)->updateForm(\route(sprintf('%supdate', $name), compact('entry'))))->name('edit');
                    \Route::post('/update', function (Request $request, $entry) use ($model) {
                        $entry = $model::findOrFail($entry);
                        $entry->update($request->all());
                        return respond()->addMessage($entry->updatedMessage(), 'success')->response();
                    })->name('update');
                });
            });
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
