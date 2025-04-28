<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'CHAKROUNE Salah Eddine',
            'email' => 'chakroune@example.com',
            'password' => Hash::make('secret'),
            'role' => 'responsable'
        ]);

        User::create([
            'name' => 'AUGUSTIN DIATTA',
            'email' => 'augustin@example.com',
            'password' => Hash::make('secret'),
            'role' => 'responsable'
        ]);
    }
}
