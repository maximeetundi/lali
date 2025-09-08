<?php

declare(strict_types=1);

namespace Domain\Shop\Customer\Models;

use Spatie\Image\Manipulations;
use Domain\Shop\Cart\Models\Cart;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Domain\Shop\Order\Models\Order;
use Domain\Access\Admin\Models\Admin;
use Domain\Shop\Customer\Enums\State;
use Domain\Shop\Customer\Enums\Gender;
use Domain\Shop\Customer\Enums\Status;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use InteractsWithMedia;
    use LogsActivity;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'email',
        'first_name',
        'last_name',
        'mobile',
        'landline',
        'password',
        'gender',
        'status',
        'timezone',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'gender'   => Gender::class,
        'status'   => Status::class,
        'state'    => State::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'reference_number';
    }

    /** @return Attribute<string, never> */
    protected function fullName(): Attribute
    {
        return Attribute::get(
            function (): string {
                if (null === $this->last_name) {
                    return $this->first_name;
                }

                return "{$this->first_name} {$this->last_name}";
            }
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /** @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\Domain\Access\Admin\Models\Admin, \Domain\Shop\Customer\Models\Customer> */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany<\Domain\Shop\Order\Models\Order> */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /** @return \Illuminate\Database\Eloquent\Relations\MorphMany<\Domain\Shop\Customer\Models\Address> */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useFallbackUrl(asset('images/no-image.webp'))
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_FILL, 40, 40);
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\Domain\Shop\Cart\Models\Cart>
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

}
