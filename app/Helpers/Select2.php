<?php


namespace RServices\Helpers;


use Illuminate\Support\Str;

class Select2
{

    public static function build()
    {
        return new self();
    }

    private $data;

    private $separator;

    public function __construct()
    {
        $this->data = [];
        $this->separator = '_';
    }

    public function addOptGroup(string $text, $children = [])
    {
        $this->data = array_merge($this->data, [Str::slug($text, $this->separator) => ['text' => $text, 'children' => $children]]);
        return $this;
    }

    public function addToOptGroup($text, $id, $group)
    {
        if (!isset($this->data[Str::slug($group, $this->separator)]))
            $this->data = array_merge($this->data, [Str::slug($text, $this->separator) => ['text' => $text, 'children' => []]]);
        $vars = $this->data[Str::slug($group, $this->separator)];
        $vars['children'][] = ['id' => $id, 'text' => $text];
        $this->data[Str::slug($group, $this->separator)] = $vars;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

}
