<?php


namespace RServices\Models;


use RServices\Helpers\Crud\FormContract;

class Permission extends \Spatie\Permission\Models\Permission
{

    use FormContract;

    public static $formFields = [
        'name:name|type:text',
        'name:guard_name|type:text',
    ];

    public static $dataTablesFields = [
        'id' => 'ID',
        'name' => 'Name',
        'guard_name' => 'Guard Name',
    ];

}
