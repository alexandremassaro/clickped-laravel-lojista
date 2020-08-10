<?php

use App\Estabelecimento;
use Illuminate\Database\Seeder;

class EstabelecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Estabelecimento::class)->create();
        factory(Estabelecimento::class)->create();

        $estabelecimento = \App\Estabelecimento::find(1);
        $estabelecimento->attachUser(1);
        $estabelecimento = \App\Estabelecimento::find(2);
        $estabelecimento->attachUser(3);
    }
}
