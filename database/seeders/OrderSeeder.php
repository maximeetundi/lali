<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Access\Admin\Models\Admin;
use Domain\Shop\Customer\Database\Factories\AddressFactory;
use Domain\Shop\Customer\Database\Factories\CustomerFactory;
use Domain\Shop\Customer\Models\Customer;
use Domain\Shop\Order\Actions\OrderCreatedPipelineAction;
use Domain\Shop\Order\Database\Factories\OrderFactory;
use Domain\Shop\Product\Enums\Status;
use Domain\Shop\Product\Models\Sku;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Helper\ProgressBar;

use function Spatie\PestPluginTestTime\testTime;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orderPipeline = app(OrderCreatedPipelineAction::class);

        $this->command
            ->withProgressBar(
                range(1, 10),
                function (int $count, ProgressBar $bar) use ($orderPipeline) {

                    testTime()->subDay();

                    /** @var \Domain\Access\Admin\Models\Admin $admin */
                    $admin = Admin::inRandomOrder()->first();

                    CustomerFactory::new(['password' => 'secret'])
                        ->count(Arr::random(range(2, 15)))
                        ->has(AddressFactory::new()->count(Arr::random(range(1, 3))))
                        ->for($admin)
                        ->active()
                        ->create();

                    self::order($orderPipeline);

                    $bar->advance();
                }
            );

        $this->command->newLine();
    }

    private static function order(OrderCreatedPipelineAction $orderPipeline): void
    {

      
        /** @var \Domain\Access\Admin\Models\Admin $admin */
        $admin = Admin::role(config('domain.access.role.admin'))
            ->inRandomOrder()
            ->first();

        /** @var \Domain\Shop\Customer\Models\Customer $customer */
        $customer = Customer::where('created_at', '<=', now())
            ->inRandomOrder()
            ->first();


            $order = OrderFactory::new()
            ->for($admin)
            ->for($customer)
            ->hasOrderItems(
                Sku::whereRelation('product', 'status', Status::IN_STOCK)
                    ->whereHas('skuStocks', function ($query) {
                        $query->whereNotNull('count');
                    })
                    ->inRandomOrder()
                    ->take(4)
                    ->get()
            )
            ->createOne();

          

        $orderPipeline->execute($order);
    }
}
