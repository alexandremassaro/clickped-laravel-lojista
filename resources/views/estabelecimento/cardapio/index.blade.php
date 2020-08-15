@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')

    <div class="row pt-4">
        <div class="col">
            <h3>
                Escolha o cardápio
            </h3>

        </div>
    </div>

    <div class="row">
        <div class="col col-xl-4 py-2 ">
            <button type="button" class="btn text-primary" data-toggle="modal" data-target="#formModal">
                <div class="card btn-light" style="width: 16rem; height: 10rem;">  
                    <div class="card-body align-middle">
                        <h1 class="card-title text-center">+</h1>
                        <h5 class="card-title text-center">Adicionar novo cardápio</h5>
                    </div>
                </div>
            </button>
        </div>
        
        @foreach($cardapios as $cardapio)
        <div class="col col-xl-4 py-2 ">
            <button class="btn">
                <div class="card" style="width: 16rem; height: 10rem;">
                    <div class="card-header">
                        <h5 class="card-title p-0 m-0">{{ $cardapio->nome }}
                        @if ($cardapio->status == 0)
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-check-circle text-danger"></i>
                        @endif
                        </h5>
                    </div> 
                    <div class="card-body">
                        <h5 class="card-title p-0 m-0">Escolha uma ação</h5>
                    </div>
                    <div class="card-footer">
                        @if ($cardapio->status != 0)
                            <a type="button" class="btn btn-outline-dark" title="Ativar Cardápio" onclick="event.preventDefault();
                            document.getElementById('select-form{{ $cardapio->id }}').submit();"><i class="far fa-check-circle"></i></a>
                            <form id="select-form{{ $cardapio->id }}" action="{{ route('cardapios_destroy', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}" method="POST" style="display: none;">
                                @method('PATCH')
                                @csrf
                            </form>
                        @endif
                        
                        <a href="{{ route('cardapios_show', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}" type="button" class="btn btn-outline-dark" title="Editar Cardápio"><i class="far fa-edit"></i></a>

                        @if ($cardapio->status != 0)
                        <a type="submit" class="btn btn-outline-danger" title="Excluir Cardápio" onclick="event.preventDefault();
                        document.getElementById('delete-form{{ $cardapio->id }}').submit();"><i class="far fa-trash-alt"></i></a>
                        <form id="delete-form{{ $cardapio->id }}" action="{{ route('cardapios_destroy', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}" method="POST" style="display: none;">
                            @method('delete')
                            @csrf
                        </form>   
                        @endif
                        
                    </div>
                </div>
            </button>
        </div>
        @endforeach
            
    </div>
</div>

<!-- Form Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModalLabel">Novo cardápio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('cardapios_store', ['estabelecimento' => $estabelecimento]) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="nome" class="col-form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
  </div>

@endsection