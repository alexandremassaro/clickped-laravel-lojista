<?php

namespace App\Http\Controllers\Api;

use App\Comanda;
use App\Estabelecimento;
use App\Http\Controllers\Controller;
use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
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
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    public function changeStatus(Request $request) {
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();
        $pedido = Pedido::where('id', $request->pedido)->first();

        if(!$estabelecimento || !$pedido)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        $pedido->status = $request->status;
        $pedido->save();

        return response()->json(['pedido' => $pedido]);

    }

    public function getRecentes(Request $request) {

        $pedidos = [];
        $estabelecimento = Estabelecimento::where(['slug' => $request->estabelecimento])->first();

        if(!$estabelecimento)
            return response()->json([
                'message' => 'Registro não encontrado',
            ], 404);

        if ($request->selectedStatus == 'All'){
            $pedidosAll = $estabelecimento->pedidos->sortByDesc('created_at')->take(10);
        }
        else{
            $pedidosAll = $estabelecimento->pedidos->where('status', $request->selectedStatus)->sortByDesc('created_at')->take(10);
        }


        foreach($pedidosAll as $pedido) {
            $items = [];
            foreach($pedido->itemPedidos as $item){
                array_push($items, ['id' => $item->id, 'nome' => $item->nome, 'preco' => $item->preco, 'quantidade' => $item->quantidade, 'observacao' => $item->observacao]);
            }

            $opcaos = [];
            foreach($pedido->opcaoItemPedidos as $opcao){
                array_push($opcaos, ['id' => $opcao->id, 'nome' => $opcao->nome, 'preco' => $opcao->preco]);
            }

            array_push($pedidos, ['id' => $pedido->id, 'status' => $pedido->status, 'statusOptions' => $pedido->statusOptions(),'mesa' => $pedido->comanda->mesa->nome, 'cliente' => $pedido->comanda->user->name, 'items' => $items, 'opcaos' => $opcaos]);
        }

        return response()->json(['pedidos' => $pedidos]);
        
    }
}
