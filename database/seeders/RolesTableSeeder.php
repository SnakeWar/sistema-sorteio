<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'title' => 'Administrador',
            'description' => 'Administrador geral',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
