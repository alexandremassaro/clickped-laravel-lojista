<?php

namespace App\Http\Controllers;

use App\Estabelecimento;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Estabelecimento $estabelecimento)
    {
        return view('estabelecimento.item.index', compact(['estabelecimento']));
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
        
        return ['url' => route('items_index', compact('estabelecimento'))];
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
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
    public function destroy(Estabelecimento $estabelecimento, Item $item)
    {

        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id){
                foreach ($item->selecaos as $selecao)
                    $selecao->delete();
                foreach ($item->complementos as $complemento){
                    foreach ($complemento->opcaos as $opcao)
                        $opcao->delete();
                    $complemento->delete();
                }
                $item->delete();
            }

        return redirect(route('items_index', compact('estabelecimento')));
    }
}
