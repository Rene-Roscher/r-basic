<?php

namespace RServices;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
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
        'name:name|type:text',
        'name:email|type:email',
        'name:password|type:text|only:create',
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

}
