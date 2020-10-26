<?php

namespace RServices;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use RServices\Helpers\Button\ButtonBuilder;
use RServices\Helpers\Crud\FormContract;
use RServices\Helpers\Crud\FormContractBuilder;
use RServices\Helpers\Datatable;
use RServices\Models\Model;
use RServices\Models\MonitorCategory;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class User
 * @package App
 * @property int id
 * @property string name
 * @property string email
 * @property string slug
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPassword
{
    use Notifiable, \Illuminate\Auth\Authenticatable, Authorizable, HasRoles, HasSlug, \Illuminate\Auth\Passwords\CanResetPassword, FormContract;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    public static $formFields = [
        'name:name|type:text|col:6',
        'name:email|type:email|col:6',
        'name:password|type:text|only:create|col:6',
        'name:roles|type:multiSelect|relation:role,name,name|col:6|only:update',
        'name:permissions|type:multiSelect|relation:permission,name,name|col:6|only:update',
    ];

    public static $dataTablesFields = [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'E-Mail'
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function update(array $attributes = [], array $options = [])
    {
        $this->syncPermissions(array_key_exists('permissions', $attributes) ? array_values($attributes['permissions']) : []);
        $this->syncRoles(array_key_exists('roles', $attributes) ? array_values($attributes['roles']) : []);
        return parent::update($attributes, $options);
    }
	
	public function updateProfile(array $attributes = [], array $options = [])
    {
        return parent::update($attributes, $options);
    }

    public static function columnAction($entry, $name)
    {
        return ButtonBuilder::create()
            ->addBlank(\route(sprintf('%s.signInto', $name), compact('entry')), 'Login', 'dark')
            ->addEdit(\route(sprintf('%s.edit', $name), compact('entry')))
            ->addDelete(\route(sprintf('%s.delete', $name), compact('entry')))->make();
    }

}
