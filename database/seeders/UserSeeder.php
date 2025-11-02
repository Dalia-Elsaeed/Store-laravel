<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dalia Allafaf',
            'email' => 'dalia@gmail.com',
            'password' => Hash::make('123'),
            'phone_number' => '21',

        ]);

        DB::table('users')->insert([

        'name' => 'Dalia Allafaf12',
            'email' => 'daliaee12@gmail.com',
            'password' => Hash::make('000'),
            'phone_number' => '2177',
        ]);
    }
}
