<?php

namespace RServices\Providers;

use RServices\Helpers\Menu\MenuBuilder;
use RServices\Facades\MenuFacade as Menu;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('menu', function ($app) {
            return new MenuBuilder();
        });
    }

    public function boot()
    {
        Menu::add(Menu::element('Dashboard', '/manage', 'fa fa-home'));
		Menu::add(Menu::model(User::class));
    }

}
