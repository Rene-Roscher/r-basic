<?php


namespace RServices\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use RServices\Helpers\Traits\HasUuid;
use Spatie\Sluggable\SlugOptions;
use Yajra\DataTables\DataTableAbstract;

/**
 * Class Model
 * @package App
 * @property int id
 * @property string created_at
 * @property string updated_at
 * @method static DataTableAbstract datatables();
 * @method static self|Builder search($source);
 * @method static self create($attr);
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    use SoftDeletes, HasUuid;

    public $incrementing = false;
    protected $keyType = 'string';

    public $slugKey = 'slug';
    public $slugField = 'name';

    public const DATE_FORMAT = 'd.m.Y - H:i';

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
        return datatables()->eloquent($query);
    }

}
