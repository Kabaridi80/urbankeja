<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $manifestPath = public_path('build/manifest.json');
    if (!file_exists($manifestPath)) {
        $manifestPath = public_path('build/.vite/manifest.json');
    }
    
    // If the file exists in the .vite folder, tell Laravel to use that
    if (file_exists($manifestPath)) {
        \Illuminate\Support\Facades\Vite::useManifestFilename(
            str_contains($manifestPath, '.vite') ? '.vite/manifest.json' : 'manifest.json'
        );
    }
    // \Illuminate\Support\Facades\Vite::useManifestFilename('manifest.json');
    }
}
