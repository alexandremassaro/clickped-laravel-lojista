<?php

namespace App\Http\Controllers\Api;

use App\Complemento;
use App\Estabelecimento;
use App\Http\Controllers\Controller;
use App\Item;
use App\Opcao;
use Illuminate\Http\Request;

class ComplementoController extends Controller
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
        $item = Item::find($request->item);
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();

        if(!$item || !$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $complemento = Complemento::create([
            'item_id' => $request->item,
            'nome' => $request->nome,
            'min' => $request->min,
            'max' => $request->max,
        ]);

        if(!$complemento)
            return response()->json([
                'message' => 'Erro ao salvar complemento',
            ], 404);

        foreach($request->opcoes as $op){
            //return ['op' => $op['nome']];
            $opcao = Opcao::create([
                'complemento_id' => $complemento->id,
                'nome' => $op['nome'],
                'preco' => $op['preco'],
            ]);
        }
        
        return response()->json(['complemento' => $complemento]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function show(Complemento $complemento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complemento $complemento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complemento $complemento)
    {
        //
    }
}
