<?php


namespace RServices\Helpers\Menu;


use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class MenuBuilder extends MenuDropdown
{

    public static function dropdown($display, $icon, $key = null) {
        return new MenuDropdown($display, $icon, $key);
    }

    public static function element($display, $href, $icon = 'icon ni ni-dot', $key = null) {
        return new MenuElement($display, $href, $icon, $key);
    }

    public static function model($model, $icon = 'fa fa-layer-group', $key = null) {
        return new MenuElement(ucwords(Str::snake(Str::plural(basename($model)), ' ')),
            \url("manage/".Str::kebab(Str::plural(basename($model)))), $icon, $key);
    }

    public function render()
    {
        $rendered = '';
        foreach ($this->getElements() as $element) {
            if(!empty($element->getPermission())) {
                if (user()->hasPermissionTo($element->getPermission()))
                    $rendered .= $element->render();
                continue;
            }
            $rendered .= $element->render();
        }
        return view('misc.sidebar.sidebar', compact('rendered'))->render();
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }

}
