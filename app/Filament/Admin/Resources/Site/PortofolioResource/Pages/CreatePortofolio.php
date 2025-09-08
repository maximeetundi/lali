<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\PortofolioResource\Pages;

use App\Filament\Admin\Resources\Site\PortofolioResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortofolio extends CreateRecord
{
    protected static string $resource = PortofolioResource::class;
}
