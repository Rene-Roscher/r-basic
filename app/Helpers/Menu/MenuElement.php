<?php


namespace RServices\Helpers\Menu;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuElement
{

    private $display;
    private $href;
    private $icon;
    private $permission;

    function __construct($display, $href, $icon, $permission = null)
    {
        $this->display = $display;
        $this->href = $href;
        $this->icon = $icon;
        $this->permission = $permission;
    }

    public function render()
    {
        return view('misc.sidebar.li', ['display' => $this->display, 'href' => $this->href, 'icon' => $this->icon])->render();
    }

    /**
     * @return mixed
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param mixed $display
     */
    public function setDisplay($display): void
    {
        $this->display = $display;
    }

    /**
     * @return mixed
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param mixed $href
     */
    public function setHref($href): void
    {
        $this->href = $href;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return null
     */
    public function getPermission()
    {
        return $this->permission;
    }

}
