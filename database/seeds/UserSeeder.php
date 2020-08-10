<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Usuário Lojista',
            'email' => 'lojista@teste.com',
            'password' => '$2y$10$4.Efjhl4TaNFbu7CdGV21e.iWTx9GPrg5yzthFTTA30B3j2MwUlD6',
            'cpf' => '11111111111'
        ]);

        factory(User::class)->create([
            'name' => 'Usuário Cliente',
            'email' => 'cliente@teste.com',
            'password' => '$2y$10$4.Efjhl4TaNFbu7CdGV21e.iWTx9GPrg5yzthFTTA30B3j2MwUlD6',
            'cpf' => '22222222222'
        ]);

        factory(User::class)->create([
            'name' => 'Usuário Lojista 2',
            'email' => 'cliente2@teste.com',
            'password' => '$2y$10$4.Efjhl4TaNFbu7CdGV21e.iWTx9GPrg5yzthFTTA30B3j2MwUlD6',
            'cpf' => '33333333333'
        ]);

        $user = \App\User::find(1);
        $user->attachRole(2);
        $user = \App\User::find(2);
        $user->attachRole(3);
        $user = \App\User::find(3);
        $user->attachRole(2);

    }
}
