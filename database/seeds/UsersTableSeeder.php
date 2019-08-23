<?php

use Illuminate\Database\Seeder;

//Model de usuário
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //inserir usuário no BD
        User::create([
            'name' => 'Carlos Ferreira',
            'email' => 'carlos@especializati.com.br',
            'password' => bcrypt('123456'),
        ]);

        //inserir usuário no BD
        User::create([
            'name' => 'Outro Usuario',
            'email' => 'contato@especializati.com.br',
            'password' => bcrypt('123456'),
        ]);

    }
}
