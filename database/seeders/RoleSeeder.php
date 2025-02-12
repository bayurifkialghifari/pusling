<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public $permissionType = ["view", "create", "update", "delete"];
    public $routeExcept = [
        "sanctum.csrf-cookie",
        "livewire.update",
        "livewire.upload-file",
        "livewire.preview-file",
        "ignition.healthCheck",
        "ignition.executeSolution",
        "ignition.updateConfig",
        "profile.edit",
        "profile.update",
        "profile.destroy",
        "login",
        "password.confirm",
        "password.update",
        "logout",
    ];
    public $adminExcept = [
        "cms.user.permohonan",
        "cms.user.inbox",
        "cms.petugas.jadwal",
    ];
    public $routeDefault = ["cms.dashboard"];
    public $routePetugas = [
        "cms.dashboard",
        "cms.petugas.jadwal",
        "cms.petugas.laporan",
        "cms.petugas.laporan.show",
        'cms.laporan.export-pdf',
    ];
    public $routeUser = [
        "cms.dashboard",
        "cms.user.permohonan",
        "cms.user.inbox",
    ];

    public function run(): void
    {
        $admin = Role::findOrCreate("admin", "web");
        $petugas = Role::findOrCreate("petugas", "web");
        $user = Role::findOrCreate("user", "web");
        $default = Role::findOrCreate("default", "web");

        // Generate Permission
        // Get all route names
        $routes = Route::getRoutes();

        foreach ($routes as $value) {
            $route = $value->getName();
            // Except route
            if (!in_array($route, $this->routeExcept) && !is_null($route)) {
                foreach ($this->permissionType as $type) {
                    $permission = $type . "." . $route;
                    $permission = Permission::findOrCreate($permission, "web");

                    // Give default permission
                    if (in_array($route, $this->routeDefault)) {
                        $default->givePermissionTo($permission);
                    }

                    // Give petugas permission
                    if (in_array($route, $this->routePetugas)) {
                        $petugas->givePermissionTo($permission);
                    }

                    // Give user permission
                    if (in_array($route, $this->routeUser)) {
                        $user->givePermissionTo($permission);
                    }

                    // Give admin permission
                    if(!in_array($route, $this->adminExcept)) {
                        $admin->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
