<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('user');

        $petugas = User::create([
            'name' => 'Petugas',
            'email' => 'petugas@petugas.com',
            'password' => bcrypt('password'),
        ]);

        $petugas->assignRole('petugas');

        $laporan = User::create([
            'name' => 'Laporan',
            'email' => 'laporan@laporan.com',
            'password' => bcrypt('password'),
        ]);

        $laporan->assignRole('laporan');
    }
}
