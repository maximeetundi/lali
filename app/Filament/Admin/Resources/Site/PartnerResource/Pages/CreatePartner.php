<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Site\PartnerResource\Pages;

use App\Filament\Admin\Resources\Site\PartnerResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;
}
