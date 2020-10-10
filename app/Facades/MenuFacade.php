<?php


namespace RServices\Facades;


use Illuminate\Support\Facades\Facade;
use RServices\Helpers\Menu\MenuBuilder;
use RServices\Helpers\Menu\MenuDropdown;
use RServices\Helpers\Menu\MenuElement;

/**
 * Class MenuFacade
 * @package App\Providers\Facades
 * @method static MenuBuilder add(MenuElement $element)
 * @method static MenuElement element($display, $href, $icon = '', $permission = null)
 * @method static MenuDropdown dropdown($display, $icon, $permission = null)
 * @method static MenuElement get($key)
 * @method static set($key, $value)
 * @method static MenuElement getElements()
 * @method static render()
 */
class MenuFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
