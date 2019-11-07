<?php

namespace App\IO\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        Route::group(['prefix' => '', 'namespace' => 'App\IO\Http\Controllers'], function () {
            $this->registerWebRoutes();
        });
    }

    /**
     * @return void
     */
    private function registerWebRoutes()
    {
        require __ROOT__ . '/routes/web.php';
    }
}
