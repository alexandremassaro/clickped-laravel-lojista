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
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 3,
            'quantidade' => 2,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 4,
            'quantidade' => 3,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 5,
            'quantidade' => 4,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 6,
            'quantidade' => 5,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 7,
            'quantidade' => 6,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 8,
            'quantidade' => 7,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 9,
            'quantidade' => 8,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 10,
            'quantidade' => 9,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 11,
            'quantidade' => 10,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 12,
            'quantidade' => 11,
        ]);
        factory(ItemPedido::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.80,
            'pedido_id' => 13,
            'quantidade' => 12,
        ]);
    }
}
