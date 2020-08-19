<?php

namespace App\Http\Controllers;

use App\Complemento;
use App\Estabelecimento;
use App\Opcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
        return ['url' => route('items_index', compact('estabelecimento'))];
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opcao  $opcao
     * @return \Illuminate\Http\Response
     */
    public function edit(Opcao $opcao)
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
    public function destroy(Estabelecimento $estabelecimento, Opcao $opcao)
    {
        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id)
                $opcao->delete();

        return redirect(route('items_index', compact('estabelecimento')));
    }
}
