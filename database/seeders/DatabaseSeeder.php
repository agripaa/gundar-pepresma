<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Roles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $role = Roles::firstOrCreate(['name_role' => 'Admin']);

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'username' => 'testuser',
                'password' => Hash::make('password'),
                'role' => $role->id,
            ]
        );

        Contact::updateOrCreate(
            ['email' => 'info@pepresma.test'],
            [
                'alamat' => 'Kampus Gunadarma, Depok',
                'no_telepon' => '81234567890',
                'map_embed' => 'https://www.google.com/maps/embed?pb=',
            ]
        );
    }
}
