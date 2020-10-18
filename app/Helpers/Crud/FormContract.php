<?php


namespace RServices\Helpers\Crud;


use RServices\Helpers\Button\ButtonBuilder;

trait FormContract
{

    public function updateForm($action = null)
    {
        return FormContractBuilder::create()->makeFrom(self::class, $this->toArray(), $action, 'Save');
    }

    public static function createForm($action = null)
    {
        return FormContractBuilder::create()->makeFrom(self::class, null, $action, 'Create');
    }

    public function updatedMessage()
    {
        return "The Entry was successfuly saved.";
    }

    public function createdMessage()
    {
        return "The Entry was created.";
    }

    public function deletedMessage()
    {
        return "The Entry was deleted.";
    }

    public static function getDataTablesButtons()
    {
        return ButtonBuilder::create()->addEdit(\route(sprintf('manage.%s.create', strtolower(basename(static::class)))), '<i class="fa fa-plus mr-1"></i> Create', 'dark col-12 col-xl-2 col-md-12 col-xs-12 mb-2')->make();
    }

}
