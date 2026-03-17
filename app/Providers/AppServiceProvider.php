<?php

namespace App\Providers;

use App\Support\AssetVersion;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Blade::directive('vasset', function ($expression) {
            return "<?php echo \\App\\Support\\AssetVersion::url({$expression}); ?>";
        });
    }
}
