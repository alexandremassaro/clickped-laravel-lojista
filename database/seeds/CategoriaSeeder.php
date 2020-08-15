<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Categoria::class)->create();

        factory(Categoria::class)->create([
            'nome' => 'Porções',
        ]);

    }
}
