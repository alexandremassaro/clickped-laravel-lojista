<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EstabelecimentoSeeder::class);
        $this->call(MesaSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(CardapioSeeder::class);
        $this->call(SelecaoSeeder::class);
        $this->call(ComandaSeeder::class);
        $this->call(PedidoSeeder::class);
        $this->call(ItemPedidoSeeder::class);
        
    }
}
