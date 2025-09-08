<?php

declare(strict_types=1);

namespace Domain\Site\Text\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Domain\Site\Text\Models\Text
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
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Text\Models\Text withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Text extends Model implements Sortable
{
    use HasSlug;
    use LogsActivity;
    use SoftDeletes;
    use SortableTrait;

    protected $fillable = [
        'name',
        'fr',
        'en',
        'fr_l',
        'en_l',
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
