<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Admin\Pages\Auth\EditProfile;
use App\Filament\Admin\Pages\Auth\Login;
use App\Filament\Admin\Pages\HealthCheckResults;
use App\Http\Middleware\CheckMainAdminPanel;
use App\Jobs\QueueJobPriority;
use App\Providers\Filament\Versions\AppVersionProvider;
use App\Providers\Filament\Versions\LivewireVersionProvider;
use App\Settings\SiteSettings;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use BezhanSalleh\FilamentLanguageSwitch\FilamentLanguageSwitchPlugin;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->brandName(fn () => app(SiteSettings::class)->name)
            ->favicon(fn () => app(SiteSettings::class)->getSiteFaviconUrl())
            ->brandLogo(fn () => app(SiteSettings::class)->getSiteLogoUrl())
            ->id('admin')
            ->path('admin')
            ->authGuard('admin')
            // TODO: remove this when in real production site
            ->login(Login::class)
            ->profile(EditProfile::class)
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
               // Widgets\AccountWidget::class,
               // Widgets\FilamentInfoWidget::class,
                //VersionsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                CheckMainAdminPanel::class,
                SetTheme::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(fn () => trans('Shop')),
                NavigationGroup::make()
                    ->label(fn () => trans('Access')),
                NavigationGroup::make()
                    ->label(fn () => trans('Settings'))
                    ->icon('heroicon-o-cog'),
                NavigationGroup::make()
                    ->label(fn () => trans('Documentation')),
                NavigationGroup::make()
                    ->label(fn () => trans('System')),
            ])
            ->navigationItems([
                NavigationItem::make('API Documentation')
                    ->url(fn () => route('scramble.docs.api'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-book-open')
                    ->group(fn () => trans('Documentation'))
                    ->sort(1)
                     ->visible(false),
                    //->visible(fn () => Filament::auth()->user()?->can('viewApiDocs') ?? false),
                NavigationItem::make('Log Viewer')
                    ->url(fn () => route('log-viewer.index'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-fire')
                    ->group(fn () => trans('System'))
                    ->sort(2)
                    ->visible(fn () => Filament::auth()->user()?->can('viewLogViewer') ?? false),
                NavigationItem::make('Horizon')
                    ->url(fn () => route('horizon.index'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-americas')
                    ->group(fn () => trans('System'))
                    ->sort(3)
                    ->visible(fn () => Filament::auth()->user()?->can('viewHorizon') ?? false),
                NavigationItem::make('Telescope')
                    ->url(fn () => route('telescope'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-sparkles')
                    ->group(fn () => trans('System'))
                    ->sort(4)
                    ->visible(function (): bool {

                        if (! class_exists('\Laravel\Telescope\TelescopeServiceProvider')) {
                            return false;
                        }

                        if (! config('telescope.enabled')) {
                            return false;
                        }

                        return Filament::auth()->user()?->can('viewTelescope') ?? false;
                    }),
            ])
            ->plugins([
                FilamentSpatieLaravelHealthPlugin::make()
                    ->usingPage(HealthCheckResults::class),
                FilamentLanguageSwitchPlugin::make()
                    ->renderHookName('panels::global-search.before'),
                // VersionsPlugin::make()
                //     ->widgetColumnSpan('full')
                //     ->widgetSort(99)
                //     ->items([
                //         new AppVersionProvider(),
                //         new LivewireVersionProvider(),
                //     ]),
                // ThemesPlugin::make(),
            ])
            ->darkMode()
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->databaseNotifications()
            ->renderHook(
                'panels::styles.after',
                fn (): string => Blade::render('<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">'),
            )
            ->renderHook(
                'panels::page.end',
                fn () => new HtmlString('
                        <p>
                            <i>Copyright © </i>
                            <a
                                href="#"
                                target="_blank"
                            >
                              <b>'.config('app.name', 'Laravel').'</b>
                            </a>
                        </p>
                    '),
            );
    }
}
