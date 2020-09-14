<?php

namespace RServices;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use RServices\Helpers\Datatable;
use RServices\Models\Model;
use RServices\ModelView\ModelView;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class User
 * @package App
 * @property int id
 * @property string name
 * @property string firstname
 * @property string lastname
 * @property string email
 * @property float amount
 * @property string avatar
 * @property string state
 * @property string language
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPassword
{
    use Notifiable, \Illuminate\Auth\Authenticatable, Authorizable, HasRoles, HasSlug, \Illuminate\Auth\Passwords\CanResetPassword;

    public $slugKey = 'slug';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name', 'firstname', 'lastname', 'amount', 'email',
        'language', 'avatar', 'state', 'password'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'payload' => 'array'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

}
