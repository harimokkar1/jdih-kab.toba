<?php

namespace App\Providers;

use App\Models\JenisPeraturan;
use App\Services\VisitorService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VisitorService::class, function () {
            return new VisitorService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Bagikan data kategori produk hukum dan statistik pengunjung ke views
        View::composer(['layouts.app', 'user.*', 'admin.dashboard'], function ($view) {
            try {
                if (Schema::hasTable('jenis_peraturans')) {
                    $navJenisPeraturan = JenisPeraturan::where('is_active', true)
                        ->orderBy('urutan')
                        ->get();
                    $view->with('navJenisPeraturan', $navJenisPeraturan);
                }

                if (Schema::hasTable('visitors')) {
                    $visitorStats = app(VisitorService::class)->getStats();
                    $view->with('visitorStats', $visitorStats);
                }
            } catch (\Throwable $e) {
                // Jangan crash bila database belum siap
            }
        });
    }
}
