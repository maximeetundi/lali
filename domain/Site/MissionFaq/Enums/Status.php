<?php

declare(strict_types=1);

namespace Domain\Site\MissionFaq\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Str;

enum Status: string implements HasColor, HasIcon, HasLabel
{
    case FAQ = 'faq';
    case MISSION = 'mission';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FAQ => 'success',
            self::MISSION => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::FAQ => 'heroicon-o-check-circle',
            self::MISSION => 'heroicon-o-x-circle',
        };
    }

    public function getLabel(): ?string
    {
        return trans(Str::headline($this->value));
    }
}
