<?php

namespace RServices\Providers;

use RServices\Helpers\Menu\MenuBuilder;
use RServices\Helpers\FontAwesome;
use RServices\Facades\MenuFacade as Menu;
use Illuminate\Support\ServiceProvider;
use RServices\Models\Permission;
use RServices\Models\Role;
use RServices\Models\Session;
use RServices\Models\User;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('menu', fn() => new MenuBuilder());
    }

    public function boot()
    {
        Menu::add(Menu::element('Dashboard', 'manage.dashboard', 'fad fa-home'));
        Menu::add(Menu::model(User::class, 'fad fa-cog'));
        Menu::add(Menu::model(Role::class, 'fad fa-layer-group'));
        Menu::add(Menu::model(Permission::class, 'fad fa-bars'));
        Menu::add(Menu::model(Session::class, 'fad fa-user-secret'));
    }

}
