<?php

namespace App\Http\Controllers\Api;

use App\Cardapio;
use App\Estabelecimento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();
        
        if(!$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $cardapio = $estabelecimento->cardapios->where('status', 0)->first();
        
        if(!$cardapio)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $selecaos = $cardapio->selecaos;
        $categorias = collect();

        foreach($selecaos as $selecao){
            $item = $selecao->item;
            $categoria = $selecao->categoria;
            $categorias->push($categoria);
        }

        $categorias = $categorias->unique();

        return response()->json([
            'cardapio' => $cardapio,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cardapio $cardapio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cardapio $cardapio)
    {
        //
    }
}
