<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages\Settings;

use App\Settings\SiteSettings;
use Domain\Access\Role\Contracts\HasPermissionPage;
use Domain\Access\Role\PermissionPages;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ManageSite extends SettingsPage implements HasPermissionPage
{
    use PermissionPages;

    protected static string $settings = SiteSettings::class;

    public function getHeading(): string
    {
        return __("Manage Site");
    }
    

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __("Manage Site");
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
                        Forms\Components\TextInput::make('name')
                            ->translateLabel()
                            ->required(),

                        FileUpload::make('favicon')
                            ->image()
                            ->required()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file) => 'favicon.'.$file->extension()
                            ),

                        FileUpload::make('logo')
                            ->image()
                            ->required()
                            ->openable()
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file) => 'logo.'.$file->extension()
                            ),
 

                        Forms\Components\Textarea::make('address')
                            ->translateLabel()
                            ->nullable()
                            ->string(),
                    ]),
            ])
            ->columns(2);
    }
}
