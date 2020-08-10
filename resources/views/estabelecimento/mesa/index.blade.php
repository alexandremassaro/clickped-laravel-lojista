@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')

    <div class="row justify-content-center py-4">
        <div class="col">
            <div class="card">
                <div class="card-header navbar">
                    <div class="row w-100 justify-content-between">
                        <div class="col-md-5">
                            <div class="h4 p-0 m-0">
                                Mesas
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form action="/mesas" method="POST">
                                <input type="text" class="form-control form-control-sm" id="nome" name="nome" placeholder="Adiciona nova mesa">
                                <input type="hidden" id="estabelecimento_id" value="{{ $estabelecimento->index }}" />
                                <button type="submit" class="d-none"></button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @foreach ($mesas as $mesa)
                        
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <a href="" class="col btn btn-light text-left">
                                        {{ $mesa->nome }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection