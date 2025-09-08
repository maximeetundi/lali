<?php

declare(strict_types=1);

namespace Domain\Site\MissionFaq\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\LogOptions;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Domain\Site\MissionFaq\Enums\Status;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Domain\Site\MissionFaq\Models\MissionFaq
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $order_column manage by spatie/eloquent-sortable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Domain\Site\Product\Models\Product[] $products
 * @property-read int|null $products_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\MissionFaq\Models\MissionFaq withoutTrashed()
 *
 * @mixin \Eloquent
 */
class MissionFaq extends Model implements Sortable
{
    use HasSlug;
    use LogsActivity;
    use SoftDeletes;
    use SortableTrait;

    protected $fillable = [
        'name',
        'fr',
        'en',
        'status',
    ];

    protected $table = "missions_faqs";

    protected $casts = [
        'status'   => Status::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo($this->getRouteKeyName());
    }

  

}
