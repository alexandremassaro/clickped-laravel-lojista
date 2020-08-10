<?php

use App\Mesa;
use Illuminate\Database\Seeder;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++){
            factory(Mesa::class)->create([
                'nome' => 'Mesa ' . $i
            ]);
        }
    }
}
