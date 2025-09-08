<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Access\AdminResource\Pages;

use App\Filament\Admin\Resources\Access\AdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;
}
