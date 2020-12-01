<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['name' => 'Categoria 1']);
        Role::create(['name' => 'Categoria 2']);
        Role::create(['name' => 'Categoria 3']);
    }
}
