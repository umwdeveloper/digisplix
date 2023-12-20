<?php

namespace App\Providers;

use App\Models\Support;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        $sharedTickets = Support::with('user')->orderByDesc('created_at')->get();

        view()->share('shared_tickets', $sharedTickets);
    }
}
