<?php

use Domain\User\Actions\Admin\CreateAdminAction;
use Domain\User\Actions\Admin\DeleteAdminAction;
use Domain\User\Actions\Admin\DestroyAdminAction;
use Domain\User\Actions\Admin\GetSelfAdminAction;
use Domain\User\Actions\Admin\GetWithTrashedAdminAction;
use Domain\User\Actions\Admin\RecoverAdminAction;
use Domain\User\Actions\Admin\UpdateSelfAdminAction;
use Domain\User\Actions\Member\GetSelfMemberAction;
use Domain\User\Actions\Authentication\LogoutAction;
use Domain\User\Actions\Authentication\RefreshAction;
use Domain\User\Actions\Authentication\ResetPasswordAction;
use Illuminate\Support\Facades\Route;

/**
 * Admin areas
 */
Route::prefix('/admin')
    ->middleware('role:admin')
    ->group(function () {
        Route::post('/', CreateAdminAction::class);
        Route::put('/', UpdateSelfAdminAction::class);
        Route::post('/me', GetSelfAdminAction::class);
        Route::post('/refresh', RefreshAction::class);
        Route::get('/with-trashed', GetWithTrashedAdminAction::class);
        Route::post('/reset-password', ResetPasswordAction::class);
        Route::post('/logout', LogoutAction::class);
        Route::put('/{id}', ResetPasswordAction::class);
        Route::delete('/{id}', DeleteAdminAction::class);
        Route::post('/{id}/recover', RecoverAdminAction::class);
        Route::delete('/{id}/destroy', DestroyAdminAction::class);
    });

/**
 * Member areas
 */
Route::prefix('/member')
    ->middleware('role:member')
    ->group(function () {
        Route::post('/me', GetSelfMemberAction::class);
        Route::post('/refresh', RefreshAction::class);
        Route::post('/reset-password', ResetPasswordAction::class);
        Route::post('/logout', LogoutAction::class);
    });
