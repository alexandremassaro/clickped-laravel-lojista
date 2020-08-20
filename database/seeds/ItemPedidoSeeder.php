<?php

use App\ItemPedido;
use Illuminate\Database\Seeder;

class ItemPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ItemPedido::class)->create();
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 2,
            'quantidade' => 1,
        ]);
    }
}
