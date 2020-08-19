<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
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
        return view('estabelecimento.categoria.index', compact('estabelecimento'));
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
    public function store(Estabelecimento $estabelecimento, Request $request)
    {
        $this->validateRequest();
        $categoria = Categoria::firstOrNew([
            'estabelecimento_id' => $estabelecimento->id,
            'nome' => $request->input('nome'),
        ]);
        $categoria->status = 0;
        
        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id)
                $categoria->save();
        
        return redirect(route('categorias_index', compact(['estabelecimento'])));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
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
    public function update(Estabelecimento $estabelecimento, Request $request, Categoria $categoria)
    {
        $categoria->update($this->validateRequest());

        return redirect(route('categorias_index', compact(['estabelecimento'])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estabelecimento $estabelecimento, Categoria $categoria)
    {
        $categoria->status = 1;
        
        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id){
                foreach($categoria->selecaos as $selecao)
                    $selecao->delete();
                $categoria->save();
            }
        
        return redirect(route('categorias_index', compact(['estabelecimento'])));
    }
    
    public function validateRequest() {

        return request()->validate([
            'nome' => 'required|min:3'
        ]);
    }
}
