<?php

namespace RServices\Providers;

use RServices\Helpers\Menu\MenuBuilder;
use RServices\Helpers\FontAwesome;
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
        $this->app->bind('menu', fn() => new MenuBuilder());
    }

    public function boot()
    {
        Menu::add(Menu::element('Dashboard', '/manage', FontAwesome::c(FontAwesome::FA_HOME)));
		Menu::add(Menu::model(User::class, FontAwesome::c(FontAwesome::FA_USERS_COG)));
		Menu::add(Menu::model(Role::class, FontAwesome::c(FontAwesome::FA_ALIGN_RIGHT)));
        Menu::add(Menu::model(Permission::class, FontAwesome::c(FontAwesome::FA_LIST)));
		Menu::add(Menu::model(Session::class, FontAwesome::c(FontAwesome::FA_USER_SECRET)));
    }

}
