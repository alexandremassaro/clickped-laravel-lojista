<?php

namespace App\Http\Controllers\Api;

use App\Cardapio;
use App\Categoria;
use App\Estabelecimento;
use App\Http\Controllers\Controller;
use App\Selecao;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }

    public function getCategoriasArray(Request $request) {
        
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();
        
        if(!$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $categorias = $estabelecimento->categorias->where('status', 0);

        $resposta = [];

        foreach($categorias as $cat){
            $selecao = Selecao::where(['categoria_id' => $cat->id, 'cardapio_id' => $request->cardapio]);
            if($selecao == null || $selecao->count() == 0)
                array_push($resposta, $cat->nome);
            $selecao = null;
        }

        return response()->json(['categorias' => $resposta]);
        
    }
}
