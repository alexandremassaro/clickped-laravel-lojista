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
            'status' => 1,
            'total' => 27.80,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 2,
            'total' => 55.60,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 3,
            'total' => 83.4,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 4,
            'total' => 111.2,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 1,
            'total' => 27.80,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 2,
            'total' => 55.60,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 3,
            'total' => 83.4,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 4,
            'total' => 111.2,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 1,
            'total' => 27.80,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 2,
            'total' => 55.60,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 3,
            'total' => 83.4,
        ]);
        factory(Pedido::class)->create([
            'comanda_id' => 1,
            'estabelecimento_id' => 1,
            'status' => 4,
            'total' => 111.2,
        ]);
    }
}
