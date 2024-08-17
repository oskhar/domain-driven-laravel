<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')
    ->group(function () {
        /**
         * Public areas
         */
        foreach (glob(base_path('routes/domain/v1/*/public.php')) as $route) {
            require $route;
        }

        /**
         * Sanctum authentication needed
         */
        Route::middleware('auth:sanctum')->group(function () {
            foreach (glob(base_path('routes/domain/v1/*/auth.php')) as $route) {
                require $route;
            }
        });
    });
