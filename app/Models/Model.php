<?php


namespace RServices\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use RServices\User;
use Spatie\Sluggable\SlugOptions;
use Yajra\DataTables\DataTableAbstract;

/**
 * Class Model
 * @package App
 * @property int id
 * @property string created_at
 * @property string updated_at
 * @method static DataTableAbstract datatables();
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    public $slugKey = 'slug';
    public $slugField = 'name';

    public const DATE_FORMAT = 'd.m.Y - H:i';

    protected static function boot()
    {
        /** Creating Uuid of User */
        self::creating(fn(User $user) => $user->id = Uuid::uuid4());
        parent::boot();
    }

    public function getRouteKeyName()
    {
        return $this->slugable ? 'slug' : $this->primaryKey;
    }

    /**
     * Used for HasSlug
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom($this->slugField)
            ->saveSlugsTo($this->slugKey);
    }

    public function scopeDatatables($query)
    {
        return datatables($query);
    }

}
