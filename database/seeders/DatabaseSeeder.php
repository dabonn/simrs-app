<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin SIMRS',
            'email'    => 'admin@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // --- POLI UMUM ---
        User::create([
            'name'     => 'dr. Andi Pratama',
            'email'    => 'andi@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Umum',
        ]);
        User::create([
            'name'     => 'dr. Sarah Wijaya',
            'email'    => 'sarah@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Umum',
        ]);

        // --- POLI GIGI ---
        User::create([
            'name'     => 'drg. Rian Hidayat',
            'email'    => 'rian@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Gigi',
        ]);
        User::create([
            'name'     => 'drg. Siti Nurhaliza',
            'email'    => 'siti@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Gigi',
        ]);

        // --- POLI ANAK ---
        User::create([
            'name'     => 'dr. Budi Santoso, Sp.A',
            'email'    => 'budi@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Anak',
        ]);
        User::create([
            'name'     => 'dr. Maya Indah, Sp.A',
            'email'    => 'maya@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Anak',
        ]);

        // --- POLI PENYAKIT DALAM ---
        User::create([
            'name'     => 'dr. Hendra Kusuma, Sp.PD',
            'email'    => 'hendra@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Penyakit Dalam',
        ]);
        User::create([
            'name'     => 'dr. Nina Lestari, Sp.PD',
            'email'    => 'nina@simrs.com',
            'password' => Hash::make('password'),
            'role'     => 'dokter',
            'poli'     => 'Poli Penyakit Dalam',
        ]);
    }
} 