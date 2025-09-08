<?php

declare(strict_types=1);

namespace Domain\Site\Asset\Models;

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
 * Domain\Site\Asset\Models\Asset
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
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Asset\Models\Asset withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Asset extends Model implements HasMedia, Sortable
{
    use HasSlug;
    use InteractsWithMedia;
    use LogsActivity;
    use SoftDeletes;
    use SortableTrait;

    protected $fillable = [
        'name',
        'url',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useFallbackUrl(asset('images/no-image.webp'))
            ->registerMediaConversions(function () {
                $this->addMediaConversion('list')
                    ->fit(Manipulations::FIT_FILL, 240, 210);
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_FILL, 40, 40);
            });
    }

}
