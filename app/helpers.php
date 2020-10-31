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
        return request()->routeIs("$uri[0].$uri[1].*") ? 'active' : null;
    if (count($uri) == 2)
        return request()->routeIs("$uri[0].$uri[1]") ? 'active' : null;
    if (count($uri) == 0)
        return request()->routeIs("$uri*") ? 'active' : null;
    throw new LogicException('No Route-Named Schema found.');
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

function viewDataTables($route, array $columns, array $titles = null, $buttons = null, $withAction = true)
{
    $instance = \RServices\Helpers\Datatable::create();
    foreach ($columns as $column) $instance->put($column);
    $instance->setColumnNames($titles);
    if ($withAction) $instance->addAction();
    return view('misc.datatables', [
        'view' => $instance->view($route),
        'buttons' => $buttons,
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
function getTypeOfValue($value)
{
    if ($value == 'true' || $value == 'false') return 'checkbox';
    switch (gettype($value)) {
        case "integer":
            return 'number';
        case "boolean":
            return 'checkbox';
        default:
            return 'text';
    }
}
function getRealFileName($class)
{
    $pathinfo = pathinfo($class);
    $realFilename = null;
    if (($count = count($ex = explode("\\", $pathinfo['filename']))) > 0)
        $realFilename = $ex[$count-1];
    return $realFilename;
}
