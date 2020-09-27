<?php

function respond()
{
    return \RServices\Response\Response::build();
}
/**
 * @return \Illuminate\Contracts\Auth\Authenticatable|null|\RServices\User
 */
function user()
{
    return auth()->user();
}
function sidebarcheck($uri)
{
    return request()->is($uri) ? 'active' : '';
}

/**
 * @return \RServices\Helpers\Menu\MenuBuilder
 */
function menu()
{
    return RServices\Facades\MenuFacade::getFacadeRoot();
}

function addMenuElement($display, $href, $icon = '', $permission = null)
{
    menu()->add(new \RServices\Helpers\Menu\MenuElement($display, $href, $icon, $permission));
}

