<?php

namespace App\Http\Controllers\Api;

use App\Estabelecimento;
use App\Http\Controllers\Controller;
use App\Item;
use App\Selecao;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();

        if(!$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $item = Item::create([
            'estabelecimento_id' => $estabelecimento->id,
            'nome' => $request->nome,
            'preco' => $request->preco,
            'descricao' => $request->descricao,
        ]);

        if(!$item)
            return response()->json([
                'message' => 'Erro ao salvar ítem',
            ], 404);
        
        return response()->json(['item' => $item]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function getItemsArray(Request $request) {

        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();
        
        if(!$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $items = $estabelecimento->items->where('status', 0);

        $resposta = [];

        foreach($items as $it){
            $selecao = Selecao::where(['item_id' => $it->id, 'cardapio_id' => $request->cardapio, 'categoria_id' => $request->categoria]);
            if($selecao == null || $selecao->count() == 0)
                array_push($resposta, ['id' => $it->id, 'nome' => $it->nome]);
            $selecao = null;
        }

        return response()->json(['items' => $resposta]);
        
    }
}
