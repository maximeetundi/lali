<?php

declare(strict_types=1);

namespace Domain\Shop\Customer\Observers;

use App\Observers\LogAttemptDeleteResource;
use Domain\Shop\Customer\Actions\GenerateCustomerReferenceNumberAction;
use Domain\Shop\Customer\Models\Customer;
use Filament\Facades\Filament;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Builder;

class CustomerObserver
{
    use LogAttemptDeleteResource;

    public function creating(Customer $customer): void
    {
        if (Filament::auth()->check()) {
            $customer->admin()->associate(Filament::auth()->id());
        }

        $customer->reference_number = app(GenerateCustomerReferenceNumberAction::class)
            ->execute();
    }

    /**
     * @throws Halt
     */
    public function deleting(Customer $customer): void
    {
        $customer->loadCount([
            'orders' => function (Builder $builder) {
                /** @var \Domain\Shop\Order\Models\Order|\Illuminate\Database\Eloquent\Builder $builder */
                $builder->withTrashed();
            },
        ]);

        if ($customer->orders_count > 0) {

            self::abortThenLogAttemptDeleteRelationCount(
                $customer,
                trans('Can not delete customer with associated orders.'),
                'orders',
                $customer->orders_count
            );

        }
    }
}
