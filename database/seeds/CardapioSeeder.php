<?php

use App\Cardapio;
use Illuminate\Database\Seeder;

class CardapioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cardapio::class)->create([
            'status' => 0,
        ]);

        factory(Cardapio::class)->create([
            'nome' => 'Terça-feira',
        ]);
    }
}
