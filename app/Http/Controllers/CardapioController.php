<?php

namespace App\Http\Controllers;

use App\Cardapio;
use App\Categoria;
use App\Estabelecimento;
use App\Item;
use App\Selecao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardapioController extends Controller
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
        $cardapios = $estabelecimento->cardapios->sortBy('status');
        
        return view('estabelecimento.cardapio.index', compact('cardapios', 'estabelecimento'));
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
    public function store(Request $request, Estabelecimento $estabelecimento)
    {
        $this->validateRequest();
        $cardapio = new Cardapio();
        $cardapio->nome = $request->input('nome');
        $cardapio->estabelecimento_id = $estabelecimento->id;
        if ($estabelecimento->cardapios->count() == 0) 
            $cardapio->status = 0;

        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id)
                $cardapio->save();
        
        return redirect(route('cardapios_index', ['estabelecimento' => $estabelecimento]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function show(Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        $selecaos = $cardapio->selecaos->sortBy('categoria_id');
        
        return view('estabelecimento.cardapio.show', compact('cardapio', 'estabelecimento', 'selecaos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function edit(Cardapio $cardapio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        foreach($estabelecimento->cardapios as $estCardapio) {
            $estCardapio->status = 1;
            $estCardapio->save();
        }

        $cardapio->status = 0;
        $cardapio->save();

        return redirect(route('cardapios_index', ['estabelecimento' => $estabelecimento]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cardapio  $cardapio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estabelecimento $estabelecimento, Cardapio $cardapio)
    {
        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id){
                Selecao::where(['cardapio_id' => $cardapio->id])->delete();
                $cardapio->delete();
            }
        
        return redirect(route('cardapios_index', ['estabelecimento' => $estabelecimento]));
    }

    public function selectCategoria(Estabelecimento $estabelecimento, Cardapio $cardapio) {
        if (request()->nome != null) {

            $categoria = Categoria::firstOrNew(['nome' => request()->nome, 'estabelecimento_id' => $estabelecimento->id]);
            if ($categoria->status == null || $categoria->status != 0) {
                $categoria->status = 0;
                $categoria->save();
            }

            $selecao = Selecao::firstOrNew(['cardapio_id' => $cardapio->id, 'categoria_id' => $categoria->id]);
            $selecao->save();
        }
        
        return redirect(route('cardapios_show', compact('estabelecimento', 'cardapio')));
    }

    public function deleteCategoria(Cardapio $cardapio, Categoria $categoria) {
        Selecao::where(['cardapio_id' => $cardapio->id, 'categoria_id' => $categoria->id])->delete();
        $estabelecimento = $categoria->estabelecimento;
        return redirect(route('cardapios_show', compact('estabelecimento', 'cardapio')));
    }

    public function selectItem(Estabelecimento $estabelecimento, Cardapio $cardapio, Categoria $categoria) {
        if (request()->id != null || request()->id != -1) {

            $item = Item::where(['id' => request()->id, 'estabelecimento_id' => $estabelecimento->id])->first();

            //dd($item);
            
            if ($item != null) {
                $selecao = Selecao::firstOrNew(['cardapio_id' => $cardapio->id, 'item_id' => $item->id, 'categoria_id' => $categoria->id]);
                $selecao->save();
                $selecao = Selecao::where(['cardapio_id' => $cardapio->id, 'categoria_id' => $categoria->id])->first();
                if ($selecao->item == null)
                    $selecao->delete();
            }

        }
        
        return redirect(route('cardapios_show', compact('estabelecimento', 'cardapio')));
    }

    public function deleteItem(Cardapio $cardapio, Categoria $categoria, Item $item) {
        Selecao::where(['cardapio_id' => $cardapio->id, 'categoria_id' => $categoria->id, 'item_id' => $item->id])->delete();
        $estabelecimento = $categoria->estabelecimento;
        return redirect(route('cardapios_show', compact('estabelecimento', 'cardapio')));
    }

    public function validateRequest() {

        return request()->validate([
            'nome' => 'required|min:3'
        ]);
    }
}
