<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Juan',
            'email'=>'juan@juan.com' ,
            'password'=>Hash::make('12345678'),
            'url'=>'www.juan.com',
        ]);

        //Esto no hace falta porque en el modelo User  ya se crea el boot
        //en el boot() que crea automaticamente el perfil.
        //$user->perfil()->create();

        /*
        DB::table('users')->insert([
            'name'=>'Juan',
            'email'=>'juan@juan.com' ,
            'password'=>Hash::make('12345678'),
            'url'=>'www.juan.com',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        */

        $user2 = User::create([
            'name'=>'Javi',
            'email'=>'javi@javi.com' ,
            'password'=>Hash::make('12345678'),
            'url'=>'www.juan.com',
        ]);

        //$user2->perfil()->create();

    }
}
