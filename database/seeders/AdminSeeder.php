<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Constantes\Auth as AuthConst;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Juana Dominguez',
            'email' => 'juanadz@email.com',
            'password' => Hash::make('123456789'),
            'rol_id' => AuthConst::ADMIN_ROL_ID,
        ]);
    }
}
