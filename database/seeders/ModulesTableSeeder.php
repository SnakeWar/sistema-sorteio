<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('modules')->delete();

        DB::table('modules')->insert([
            [
                'title' => 'Usuarios',
                'url' => 'users',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Grupos',
                'url' => 'roles',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Páginas',
                'url' => 'pages',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Contato',
                'url' => 'contacts',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Trabalhe Conosco',
                'url' => 'workwithus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Postagens',
                'url' => 'posts',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Produtos',
                'url' => 'products',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Modulos',
                'url' => 'modules',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Categorias',
                'url' => 'categories',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Logs',
                'url' => 'url',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
