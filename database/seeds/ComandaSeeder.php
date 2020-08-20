<?php

use App\Comanda;
use Illuminate\Database\Seeder;

class ComandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comanda::class)->create();
    }
}
