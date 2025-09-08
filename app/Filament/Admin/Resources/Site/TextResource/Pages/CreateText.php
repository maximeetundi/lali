<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\TextResource\Pages;

use App\Filament\Admin\Resources\Site\TextResource;
use Filament\Resources\Pages\CreateRecord;

class CreateText extends CreateRecord
{
    protected static string $resource = TextResource::class;
}
