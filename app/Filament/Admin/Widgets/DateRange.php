<?php

declare(strict_types=1);

namespace App\Filament\Admin\Widgets;

use Illuminate\Support\Carbon;
use Livewire\Attributes\On;

trait DateRange
{
    public ?Carbon $fromDate = null;

    public ?Carbon $toDate = null;

    #[On('updateFromDate')]
    public function updateFromDate(?string $from): void
    {
        $this->fromDate = Carbon::make($from);
        $this->updateChartData();
    }

    #[On('updateToDate')]
    public function updateToDate(?string $to): void
    {
        $this->toDate = Carbon::make($to);
        $this->updateChartData();
    }
}
