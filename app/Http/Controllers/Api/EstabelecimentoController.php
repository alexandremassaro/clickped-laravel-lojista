<?php

namespace App\Http\Controllers\Api;

use App\Estabelecimento;
use App\Http\Controllers\Controller;
use App\Mesa;
use Illuminate\Http\Request;

class EstabelecimentoController extends Controller
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
     * @param  \App\Estabelecimento  $estabelecimento
     * @return \Illuminate\Http\Response
     */
    public function show(Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Check no estabelecimento
     */
    public function checkIn(Mesa $mesa) 
    {
        return response()->json([
            'estabelecimento' => $mesa->estabelecimento->slug,
            'mesa' => $mesa->id,
        ]);
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
}
