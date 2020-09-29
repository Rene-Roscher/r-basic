<?php


namespace RServices\Helpers\Menu;


class MenuDropdown extends MenuElement
{

    public $elements;
    private $display;
    private $icon;
    private $permission;

    /**
     * MenuDropdown constructor.
     * @param null $display
     * @param null $icon
     * @param null $permission
     */
    function __construct($display = null, $icon = null, $permission = null)
    {
        $this->elements = [];
        $this->display = $display;
        $this->icon = $icon;
        $this->permission = $permission;
    }

    function add(MenuElement $element)
    {
        array_push($this->elements, $element);
        return $this;
    }

    public function render() {
        $rendered = '';
        foreach ($this->elements as $element)
            $rendered .= $element->render();
        $display = $this->display;
        $icon = $this->icon;
        return view('misc.sidebar.ul', compact('rendered', 'display', 'icon'))->render();
    }

    /**
     * @return array|MenuElement
     */
    public function getElements(): array
    {
        return $this->elements;
    }

}
