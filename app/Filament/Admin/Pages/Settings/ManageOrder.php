<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages\Settings;

use App\Settings\OrderSettings;
use Domain\Access\Admin\Models\Admin;
use Domain\Access\Role\Contracts\HasPermissionPage;
use Domain\Access\Role\PermissionPages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Str;

class ManageOrder extends SettingsPage implements HasPermissionPage
{
    use PermissionPages;

    protected static string $settings = OrderSettings::class;

    protected static ?int $navigationSort = 2;

    public function getHeading(): string
    {
        return __("Manage Orders");
    }

    public static function getNavigationLabel(): string
    {
        return __("Manage Orders");
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('Settings');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('prefix')
                            ->translateLabel()
                            ->required()
                            ->minValue(3)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn (Set $set, $state) => $set(
                                    'prefix',
                                    (string) Str::of($state)
                                        ->upper()
                                        ->replace(' ', '_')
                                        ->trim()
                                )
                            )
                            ->alphaDash(),

                        Forms\Components\Select::make('admin_notification_ids')
                            ->label('Admin Notifications')
                            ->translateLabel()
                            ->multiple()
                            // TODO: add limit on result options for dropdown
                            ->options(Admin::pluck('name', 'id'))
                            ->getSearchResultsUsing(
                                fn (string $search): array => Admin::where('name', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->orderBy('name')
                                    ->pluck('name', 'id')
                                    ->toArray()
                            )
                            ->searchable()
                            ->required(),
                    ]),
            ])
            ->columns(2);
    }
}
