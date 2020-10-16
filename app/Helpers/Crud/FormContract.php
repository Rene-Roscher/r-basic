<?php


namespace RServices\Helpers\Crud;


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

}
