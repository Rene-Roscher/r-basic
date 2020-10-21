<?php


namespace RServices\Transformers\DataTables;


use League\Fractal\TransformerAbstract;

abstract class AbstractTransformer extends TransformerAbstract
{
    private $class;
    private $action;

    /**
     * AbstractTransformer constructor.
     * @param $class
     * @param $action
     */
    public function __construct($class, $action)
    {
        $this->class = $class;
        $this->action = $action;
    }

    public function getAction($identifiererValue)
    {
        return str_replace(urlencode($this->class), $identifiererValue, $this->action);
    }

}
