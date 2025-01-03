<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cms',
    'as' => 'cms.',
    'middleware' => ['auth', 'validate-role-permission'],
], function () {

    Route::get('/', App\Livewire\Dashboard::class)->name('dashboard');

    // Admin Permohonan
    Route::get('/admin-permohonan', App\Livewire\Cms\Admin\Permohonan::class)->name('admin.permohonan');

    // User Permohonan
    Route::get('/user-permohonan', App\Livewire\Cms\User\Permohonan::class)->name('user.permohonan');
    Route::get('/inbox', App\Livewire\Cms\User\Inbox::class)->name('user.inbox');

    // Management Menu
    Route::get('/management/menu', App\Livewire\Cms\Management\Menu::class)->name('management.menu');
    Route::get('/management/menu/{menu}', App\Livewire\Cms\Management\Menu\Child::class)->name('management.menu.child');

    // Management Role
    Route::get('/management/role', App\Livewire\Cms\Management\Role::class)->name('management.role');
    Route::get('/management/role-permission/{role?}', App\Livewire\Cms\Management\Role\Permission::class)->name('management.role-permission');

    // Management User
    Route::get('/management/user', App\Livewire\Cms\Management\User::class)->name('management.user');

    // Access Control
    Route::get('/management/access-control', App\Livewire\Cms\Management\AccessControl::class)->name('management.access-control');

    // Setting
    Route::get('/management/setting-general', App\Livewire\Cms\Management\Setting\General::class)->name('management.general-setting');
    Route::get('/management/setting-misc', App\Livewire\Cms\Management\Setting\Misc::class)->name('management.misc-setting');
    Route::get('/management/setting-mail', App\Livewire\Cms\Management\Setting\Mail::class)->name('management.mail-setting');
    Route::get('/management/setting-privacy-policy', App\Livewire\Cms\Management\Setting\PrivacyPolicy::class)->name('management.privacy-policy-setting');
    Route::get('/management/setting-terms-of-service', App\Livewire\Cms\Management\Setting\TermOfService::class)->name('management.term-of-service-setting');

    // Logs
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});
