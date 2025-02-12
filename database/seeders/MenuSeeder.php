<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dashboard = Menu::create([
            "name" => "Dashboard",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-home",
            "route" => "cms.dashboard",
            "ordering" => "1",
        ]);

        $this->adminMenu();
        $this->userMenu();
        $this->petugasMenu();
    }

    public function adminMenu()
    {
        // Admin Permohonan
        $verificator = Menu::create([
            "name" => "Data Permohonan",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-file",
            "route" => "cms.admin.permohonan",
            "ordering" => "2",
        ]);
        // Admin Jadwal
        $jadwal = Menu::create([
            "name" => "Data Jadwal",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-calendar",
            "route" => "cms.admin.jadwal",
            "ordering" => "3",
        ]);
        // Admin Petugas
        $jadwal = Menu::create([
            "name" => "Data Petugas",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-users",
            "route" => "cms.admin.petugas",
            "ordering" => "4",
        ]);
        // Website Setting
        $admin = Menu::create([
            "name" => "Management",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-cog",
            "route" => "#",
            "ordering" => "90",
        ]);
        $admin->menuChildren()->create([
            "name" => "Menu",
            "icon" => "#",
            "route" => "cms.management.menu",
            "ordering" => "1",
        ]);

        $admin->menuChildren()->create([
            "name" => "Role",
            "icon" => "#",
            "route" => "cms.management.role",
            "ordering" => "2",
        ]);
        $admin->menuChildren()->create([
            "name" => "User",
            "icon" => "#",
            "route" => "cms.management.user",
            "ordering" => "3",
        ]);
        $admin->menuChildren()->create([
            "name" => "Setting",
            "icon" => "#",
            "route" => "cms.management.general-setting",
            "ordering" => "4",
        ]);
        $admin->menuChildren()->create([
            "name" => "Access Control",
            "icon" => "#",
            "route" => "cms.management.access-control",
            "ordering" => "5",
        ]);
    }

    public function userMenu()
    {
        // User Pemohonan
        $pemohon = Menu::create([
            "name" => "Pemohonan",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-file",
            "route" => "cms.user.permohonan",
            "ordering" => "2",
        ]);
        $inbox = Menu::create([
            "name" => "Inbox",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-inbox",
            "route" => "cms.user.inbox",
            "ordering" => "3",
        ]);
    }

    public function petugasMenu()
    {
        // Petugas Jadwal
        $jadwal = Menu::create([
            "name" => "Jadwal Kunjungan",
            "on" => "cms",
            "type" => "item",
            "icon" => "fa fa-calendar",
            "route" => "cms.petugas.jadwal",
            "ordering" => "2",
        ]);
    }
}
