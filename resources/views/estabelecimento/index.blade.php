@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h3>
                Escolha o estabelecimento
            </h3>

        </div>
    </div>

    <div class="row">
        <div class="col col-xl-4 py-2">
            <a href="" class="btn p-0 text-primary">
                <div class="card btn-light" style="width: 18rem; height: 10rem;">  
                    <div class="card-body align-middle">
                        <h1 class="card-title text-center">+</h1>
                        <h5 class="card-title text-center">Adicionar novo estabelecimento</h5>
                    </div>
                </div>
            </a>
        </div>
        
        @foreach($estabelecimentos as $estabelecimento)
        <div class="col col-xl-4 py-2">
            <a href="" class="btn p-0">
                <div class="card btn-light" style="width: 18rem; height: 10rem;">
                    <div style="height: 100px;" class="justify-content-center text-center">
                        <img class="card-img-top img-fluid mh-100 w-auto" src="/images/logo_ver_dark_500.png" alt="Logo Estabelecimento">
                    </div>  
                    <div class="card-body text-left">
                        <h5 class="card-title">{{ $estabelecimento->nome_fantasia }}</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
            
    </div>
    
      
</div>
@endsection