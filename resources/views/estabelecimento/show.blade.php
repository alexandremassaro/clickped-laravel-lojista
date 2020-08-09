@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-2">
            <nav class="navbar navbar-expand-md navbar-light py-4">
                
                <button class="navbar-toggler bg-white " type="button" data-toggle="collapse" data-target="#appMenuContent" aria-controls="appMenuContent" aria-expanded="false" aria-label="Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-white shadow-sm rounded border px-2"  id="appMenuContent">
                    <ul class="nav flex-column navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="collapse" href="#menuCadastro" aria-expanded="false" aria-controls="menuCadastro">Cadastros</a>
                            <div class="collapse" id="menuCadastro">
                                <ul class="nav flex-column navbar-nav">
                                    <li class="nav-item pl-3 hover-focus">
                                        <a class="nav-link active" href="#">Mesas</a>
                                    </li>
                                    <li class="nav-item pl-3 hover-focus">
                                        <a class="nav-link active" href="#">Cardápio</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dados do restaurante</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Bem-vindo à área do lojista</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection