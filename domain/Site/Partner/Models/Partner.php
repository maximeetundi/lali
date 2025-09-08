<?php

declare(strict_types=1);

namespace Domain\Site\Partner\Models;

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
 * Domain\Site\Partner\Models\Partner
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
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Site\Partner\Models\Partner withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Partner extends Model implements HasMedia, Sortable
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
