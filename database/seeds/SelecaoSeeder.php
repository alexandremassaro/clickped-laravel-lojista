<?php

use App\Selecao;
use Illuminate\Database\Seeder;

class SelecaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Selecao::class)->create();
        factory(Selecao::class)->create([
            'categoria_id' => 2,
            'item_id' => 2,
        ]);
    }
}
