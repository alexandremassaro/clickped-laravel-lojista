<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create([
            'nome' => 'Admin'
        ]);
        factory(Role::class)->create([
            'nome' => 'Lojista'
        ]);
        factory(Role::class)->create([
            'nome' => 'Usuário'
        ]);
    }
}
