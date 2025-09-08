<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Shop\OrderResource\Pages;

use App\Filament\Admin\Resources\Shop\OrderResource;
use App\Filament\Admin\Resources\Shop\OrderResource\Schema\OrderSchema;
use Domain\Shop\Order\Actions\OrderCreatedPipelineAction;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * @property-read \Domain\Shop\Order\Models\Order $record
 */
class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    public function form(Form $form): Form
    {
        return OrderSchema::createForm(
            parent::form($form),
            submitAction: $this->getSubmitFormAction(),
            cancelAction: $this->getCancelFormAction(),
        );
    }

    /** @throws Throwable */
    protected function afterCreate(): void
    {
        DB::transaction(
            fn () => app(OrderCreatedPipelineAction::class)
                ->execute($this->record)
        );
    }

    public function getFormActions(): array
    {
        return [];
    }
}
