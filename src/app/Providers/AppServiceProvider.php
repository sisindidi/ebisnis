<?php

namespace App\Providers;

use App\Policies\ActivityPolicy;
use Filament\Actions\MountableAction;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Activity::class, ActivityPolicy::class);
        Page::formActionsAlignment(Alignment::Right);
        Notifications::alignment(Alignment::End);
        Notifications::verticalAlignment(VerticalAlignment::End);
        Page::$reportValidationErrorUsing = function (ValidationException $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();
        };
        MountableAction::configureUsing(function (MountableAction $action) {
            $action->modalFooterActionsAlignment(Alignment::Right);
        });

        // Register Filament custom Livewire widgets to prevent ComponentNotFoundException
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('app.filament.admin.widgets.menu-stats-overview', \App\Filament\Admin\Widgets\MenuStatsOverview::class);
            \Livewire\Livewire::component('app.filament.admin.widgets.dashboard-stats-overview', \App\Filament\Admin\Widgets\DashboardStatsOverview::class);
            \Livewire\Livewire::component('app.filament.admin.widgets.orders-chart-widget', \App\Filament\Admin\Widgets\OrdersChartWidget::class);
            \Livewire\Livewire::component('app.filament.admin.widgets.latest-orders-widget', \App\Filament\Admin\Widgets\LatestOrdersWidget::class);
        }
    }
}
