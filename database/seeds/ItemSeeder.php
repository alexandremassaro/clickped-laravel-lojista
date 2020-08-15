<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Item::class)->create();

        factory(Item::class)->create([
            'nome' => 'Frango a passarinho',
            'descricao' => 'Porção de frango a passarinho, acompanha 2 tipos de molho.',
            'preco' => 27.8,
        ]);
    }
}
