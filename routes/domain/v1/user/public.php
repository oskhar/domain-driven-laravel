<?php

use Domain\User\Actions\Admin\GetAllAdminAction;
use Domain\User\Actions\Authentication\AdminLoginAction;
use Domain\User\Actions\Authentication\MemberLoginAction;
use Illuminate\Support\Facades\Route;

/**
 * Admin areas
 */
Route::prefix("/admin")->group(function () {
    Route::get('/', GetAllAdminAction::class);
    Route::post('/login', AdminLoginAction::class);
});

/**
 * Member areas
 */
Route::prefix("/member")->group(function () {
    Route::post('/login', MemberLoginAction::class);
});
