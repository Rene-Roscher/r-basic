<?php


namespace RServices\Helpers\Crud;


use RServices\Helpers\Button\ButtonBuilder;
use RServices\User;

trait FormContract
{
    public function updateForm($action = null)
    {
        return FormContractBuilder::create()->makeFrom(self::class, $this, $action, 'Save');
    }

    public static function createForm($action = null)
    {
        return FormContractBuilder::create()->makeFrom(self::class, null, $action, 'Create');
    }

    public function updatedMessage()
    {
        return trans('crud.updated');
    }

    public function createdMessage()
    {
        return trans('crud.created');
    }

    public function deletedMessage()
    {
        return trans('crud.deleted');
    }

    public static function getTableViewButtons()
    {
        return ButtonBuilder::create()->addEdit(\route(sprintf('manage.%s.create', strtolower(getRealFileName(static::class)))), '<i class="fa fa-plus mr-1"></i> Create', 'dark col-12 col-xl-2 col-md-12 col-xs-12 mb-2')->make();
    }

    public static function columnAction($entry, $name)
    {
        return ButtonBuilder::create()
            ->addEdit(\route(sprintf('%s.edit', $name), compact('entry')))
            ->addDelete(\route(sprintf('%s.delete', $name), compact('entry')))
            ->make();
    }

    public static function toDataTables($entry, $name)
    {
        $dataTables = method_exists($entry, 'datatables') ? $entry::datatables() : datatables()->eloquent($entry::query());
        if (!is_null($transformer = $entry::dataTablesTransformer($entry::columnAction($entry, $name))))
            return $dataTables->setTransformer($transformer)->make();
        return $dataTables->addColumn('action', fn($entry) => $entry::columnAction($entry, $name))->make();
    }

    public static function dataTablesTransformer($action)
    {
        return null;
    }

}
