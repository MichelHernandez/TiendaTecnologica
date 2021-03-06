<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 777,
            'description' => 'administrador',
        ]);

        DB::table('roles')->insert([
            'id' => 256,
            'description' => 'cliente',
        ]);
    }
}
