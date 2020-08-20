<?php

use App\Pedido;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Pedido::class)->create();
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 0,
            'total' => 27.80,
        ]);
    }
}
