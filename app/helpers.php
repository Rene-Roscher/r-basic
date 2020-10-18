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
    if (count($uri = explode('.', $uri)) == 3)
        return request()->routeIs("manage.$uri[1].*") ? 'active' : null;
    if (count($uri) == 2)
        return request()->routeIs("manage.$uri[1]") ? 'active' : null;
    if (count($uri) == 0)
        return request()->routeIs("$uri*") ? 'active' : null;
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

function viewDataTables($route, array $columns, array $titles = null, $withAction = true)
{
    $instance = \RServices\Helpers\Datatable::create();
    foreach ($columns as $column) $instance->put($column);
    $instance->setColumnNames($titles);
    if ($withAction)
        $instance->addAction();
    return view('misc.datatables', [
        'view' => $instance->view($route)
    ]);
}
function fontAwesome($class, $type = 'fa')
{
    return \RServices\Helpers\FontAwesome::i($class, $type);
}
function model_path($model)
{
    return sprintf('RServices\Models\%s', $model);
}
