<?php


namespace RServices\Helpers\Button;


class ButtonBuilder
{

    public static function create()
    {
        return new self();
    }

    private $buttons;
    private $html;

    public function __construct()
    {
        $this->html = '';
        $this->buttons = 0;
    }

    public function addEdit($href, $title = 'Edit', $class = 'primary')
    {
        return $this->add('edit', $href, $title, $class);
    }

	public function addWhen($condination, $href, $title = 'Edit', $class = 'primary')
    {
        return $condination ? $this->add('edit', $href, $title, $class) : $this;
    }

    public function addBlank($href, $title = 'Edit', $class = 'primary')
    {
        return $this->add('blank', $href, $title, $class);
    }

    public function addDelete($href, $title = 'Delete', $class = 'danger')
    {
        return $this->add('delete', $href, $title, $class);
    }

    public function addJsDelete($href, $title = 'Delete', $class = 'danger')
    {
        return $this->add('delete', $href, $title, $class);
    }

    public function add($button, $href, $title = 'Show', $class = 'primary', $margin = true)
    {
        $this->html .= ButtonHelper::$button($href, $title, $class, $margin && $this->buttons >= 1 ? 'ml-2' : null);
        $this->buttons++;
        return $this;
    }

    /**
     * @return string
     */
    public function make(): string
    {
        return $this->html;
    }

}
