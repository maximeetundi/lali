<?php

declare(strict_types=1);

namespace App\Providers;

use App\Providers\Macros\BluePrintMixin;
use Domain\Access\Admin\Models\Admin;

use Domain\Shop\Brand\Models\Brand;
use Domain\Shop\Cart\Models\Cart;
use Domain\Shop\Category\Models\Category;
use Domain\Shop\Customer\Models\Address;
use Domain\Shop\Customer\Models\Customer;
use Domain\Shop\Order\Models\Order;
use Domain\Shop\Product\Models\Attribute;
use Domain\Shop\Product\Models\AttributeOption;
use Domain\Shop\Product\Models\Product;
use Domain\Shop\Product\Models\Sku;
use Domain\Shop\Stock\Models\SkuStock;
use Domain\Site\Asset\Models\Asset;
use Domain\Site\Partner\Models\Partner;
use Domain\Site\MissionFaq\Models\MissionFaq;
use Domain\Site\Portofolio\Models\Portofolio;
use Domain\Site\Text\Models\Text;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use ReflectionException;
use Sentry\Laravel\Integration;
use TiMacDonald\JsonApi\JsonApiResource;

class AppServiceProvider extends ServiceProvider
{
    /** @throws ReflectionException */
    public function boot(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());
        Model::handleLazyLoadingViolationUsing(Integration::lazyLoadingViolationReporter());

        Relation::enforceMorphMap([
            Admin::class,
            Product::class,
            Customer::class,
            Order::class,
            Sku::class,
            Attribute::class,
            AttributeOption::class,
            Brand::class,
            Address::class,
            Category::class,
            SkuStock::class,
            Cart::class,
            Asset::class,
            Text::class,
            Partner::class,
            MissionFaq::class,
            Portofolio::class,
            config('permission.models.role'),
            config('permission.models.permission'),
        ]);

        Password::defaults(
            fn () => $this->app->environment('local', 'testing')
                ? Password::min(4)
                : Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
        );

        $this->macros();

        if (class_exists($class = '\Laravel\Telescope\TelescopeServiceProvider')) {
            $this->app->register($class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        JsonApiResource::resolveIdUsing(fn (Model $model): string => (string) $model->getRouteKey());
    }

    /** @throws ReflectionException */
    private function macros(): void
    {
        if ($this->app->runningInConsole()) {
            Blueprint::mixin(new BluePrintMixin());
        }

        Rule::macro(
            'email',
            fn (): string => app()->environment('local', 'testing')
                ? 'email'
                : 'email:rfc,dns'
        );
    }
}
