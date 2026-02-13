<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Auth\AdminLogin;
use App\Filament\Pages\Dashboard;



class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel

            ->id('admin')
            ->path('admin')
            ->login(AdminLogin::class)                // <-- gunakan custom login class
            ->authGuard('admin')                // <-- pastikan guard admin dipakai (optional convenience)
            ->authPasswordBroker('admin')
            ->passwordReset()

            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
               \App\Filament\Pages\Dashboard::class,

            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')

            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                \App\Filament\Widgets\PermohonanSuratStats::class,
                \App\Filament\Admin\Widgets\PermohonanChart::class,

            ])
          ->profile()
          ->databaseNotifications()




// custom

            // ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop()

            // ->default()
            ->brandName('DESA LEMAHBANG')
            // ->brandLogo(asset('storage/images/logo-desa.png'))
            // ->brandLogoHeight('32px')
            // ->sidebarWidth('270px')

            // ->brand(fn () => view('filament.brand'))
            // ->brandView('filament.brand')
            ->renderHook('panels::brand', fn () => view('filament.brand'))
            ->brandLogoHeight('32px')


            ->favicon(asset('storage/images/logo-desa.png'))



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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
