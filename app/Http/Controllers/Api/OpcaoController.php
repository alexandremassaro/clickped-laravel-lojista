<?php

namespace App\Http\Controllers\Api;

use App\Complemento;
use App\Estabelecimento;
use App\Http\Controllers\Controller;
use App\Opcao;
use Illuminate\Http\Request;

class OpcaoController extends Controller
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
        $complemento = Complemento::find($request->complemento);
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();

        if(!$complemento || !$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $opcao = Opcao::create([
            'complemento_id' => $request->complemento,
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        if(!$opcao)
            return response()->json([
                'message' => 'Erro ao salvar opção',
            ], 404);
        
        return response()->json(['opcao' => $opcao]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Opcao  $opcao
     * @return \Illuminate\Http\Response
     */
    public function show(Opcao $opcao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opcao  $opcao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opcao $opcao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opcao  $opcao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opcao $opcao)
    {
        //
    }
}
