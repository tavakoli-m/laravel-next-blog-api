<?php

namespace App\Base\ApiResponse\Providers;

use App\Base\ApiResponse\ApiResponseBuilder;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('apiResponse', function () {
            return new ApiResponseBuilder();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
