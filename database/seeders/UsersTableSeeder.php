<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Mayrcon',
            'email' => 'mayrcon_marlon@hotmail.com',
            'password' => bcrypt('1q2w3e4r'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
