<?php


namespace RServices\Helpers\Menu;


class MenuBuilder extends MenuDropdown
{

    public static function dropdown($display, $icon, $key = null) {
        return new MenuDropdown($display, $icon, $key);
    }

    public static function element($display, $href, $icon = 'icon ni ni-dot', $key = null) {
        return new MenuElement($display, $href, $icon, $key);
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
