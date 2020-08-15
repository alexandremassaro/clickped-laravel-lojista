<?php

namespace App\Http\Controllers;

use App\Estabelecimento;
use App\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesaController extends Controller
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
        $mesas = Mesa::where('estabelecimento_id', $estabelecimento->id)->orderBy('id', 'desc')->paginate(10);
        //$mesas = $estabelecimento->mesas->sortDesc()->paginate(10);
            
        return view('estabelecimento.mesa.index', compact('mesas', 'estabelecimento'));
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
        $mesa = new Mesa();
        $mesa->nome = $request->input('nome');
        $mesa->estabelecimento_id = $estabelecimento->id;

        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id)
                $mesa->save();
        
        return redirect(route('mesas_index', compact(['estabelecimento'])));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(Estabelecimento $estabelecimento, Request $request, Mesa $mesa)
    {
        $mesa->update($this->validateRequest());

        return redirect(route('mesas_index', compact(['estabelecimento'])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estabelecimento $estabelecimento, Mesa $mesa)
    {
        foreach (Auth::user()->estabelecimentos as $user_estabelecimento)
            if ($user_estabelecimento->id == $estabelecimento->id)
                $mesa->delete();
        
        return redirect(route('mesas_index', compact(['estabelecimento'])));
    }

    public function validateRequest() {

        return request()->validate([
            'nome' => 'required|min:3'
        ]);
    }
}
