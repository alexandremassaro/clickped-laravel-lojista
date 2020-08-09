<?php

namespace App\Http\Controllers;

use App\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstabelecimentoController extends Controller
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
    public function index()
    {
        $client = false;
        $lojista = false;
        $user = Auth::user();

        foreach ($user->roles as $role)
            if ($role->id == 2) $lojista = true;
            elseif ($role->id == 3) $client = true;

        if ($client && !$lojista)
            return redirect('estabelecimento/create');        

            
        $this->authorize('viewAny', Estabelecimento::class);

        $estabelecimentos = $user->estabelecimentos;
            
        return view('estabelecimento.index', compact('estabelecimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estabelecimento = new Estabelecimento();
        return view('estabelecimento.create', compact('estabelecimento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estabelecimento = Estabelecimento::create($this->validateRequest());

        $user = Auth::user();
        if (!$user->roles->has(2)) $user->attachRole(2);

        return redirect('estabelecimento');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function show(Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estabelecimento $estabelecimento)
    {
        //
    }

    public function validateRequest() {

        return request()->validate([
            'razao_social' => 'required|min:3',
            'nome_fantasia' => 'required|min:3',
            'cnpj' => 'required|min:14|max:14',
        ]);
    }
}
