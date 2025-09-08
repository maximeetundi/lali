<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\AssetResource\Pages;

use App\Filament\Admin\Resources\Site\AssetResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAsset extends CreateRecord
{
    protected static string $resource = AssetResource::class;
}
