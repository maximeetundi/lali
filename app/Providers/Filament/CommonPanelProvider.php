<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Providers\Macros\FilamentActionMixin;
use App\Providers\Macros\FilamentRadioMixin;
use App\Providers\Macros\FilamentSelectFilterMixin;
use App\Providers\Macros\FilamentSelectMixin;
use Filament\Actions\StaticAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class CommonPanelProvider extends ServiceProvider
{
    public function boot(): void
    {
        self::configureComponents();

        self::registerMacros();

        // Tables\Table::$defaultCurrency = 'usd';
        Infolist::$defaultDateTimeDisplayFormat =
        Tables\Table::$defaultDateTimeDisplayFormat = 'M d, Y h:i A';

        Page::$reportValidationErrorUsing = function (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();
        };
    }

    private static function registerMacros(): void
    {
        Forms\Components\Select::mixin(new FilamentSelectMixin());
        Forms\Components\Radio::mixin(new FilamentRadioMixin());
        Tables\Filters\SelectFilter::mixin(new FilamentSelectFilterMixin());
        StaticAction::mixin(new FilamentActionMixin());
    }

    private static function configureComponents(): void
    {
        Infolists\Components\TextEntry::configureUsing(
            function (Infolists\Components\TextEntry $component) {
                if (Filament::auth()->check()) {
                    $component
                        ->timezone(
                            /** @phpstan-ignore-next-line  */
                            Filament::auth()->user()->timezone
                        );
                }
            }
        );

        Forms\Components\DateTimePicker::configureUsing(
            function (Forms\Components\DateTimePicker $component): void {
                if (Filament::auth()->check()) {
                    $component
                        ->timezone(
                            /** @phpstan-ignore-next-line  */
                            Filament::auth()->user()->timezone
                        );
                }
            }
        );
        Tables\Columns\TextColumn::configureUsing(
            function (Tables\Columns\TextColumn $column): void {
                if (Filament::auth()->check()) {
                    $column
                        ->timezone(
                            /** @phpstan-ignore-next-line  */
                            Filament::auth()->user()->timezone
                        );
                }
            }
        );
        Tables\Table::configureUsing(
            fn (Tables\Table $table) => $table
                ->paginated([5, 10, 25, 50, 100])
        );
        Forms\Components\TextInput::configureUsing(
            fn (Forms\Components\TextInput $textInput) => $textInput
                ->maxLength(255)
        );
    }
}
