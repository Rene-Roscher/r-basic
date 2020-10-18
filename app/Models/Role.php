<?php


namespace RServices\Models;


use RServices\Helpers\Crud\FormContract;

class Role extends \Spatie\Permission\Models\Role
{

    use FormContract;

    public static $formFields = [
        'name:name|type:text',
        'name:guard_name|type:text',
        'name:permissions|type:multiSelect|relation:permission,name,name|col:4|only:update',
    ];

    public static $dataTablesFields = [
        'id' => 'ID',
        'name' => 'Name',
        'guard_name' => 'Guard Name',
    ];

    public function update(array $attributes = [], array $options = [])
    {
        $this->syncPermissions(array_key_exists('permissions', $attributes) ? array_values($attributes['permissions']) : []);
        return parent::update($attributes, $options);
    }

}
