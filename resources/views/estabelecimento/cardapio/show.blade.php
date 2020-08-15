@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')
    <div class="row pt-4">
        <div class="col">
            <h1><span>Cardápio - {{ $cardapio->nome }}</span></h1>
        </div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-outline-dark" title="Adicionar categoria" data-toggle="modal" data-target="#addCategoriaModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

        
        @for($i = 0; $i < $cardapio->selecaos->count(); $i++)
            @if ($i == 0 || $selecaos[$i]->categoria->id != $cardapio->selecaos->sortBy('categoria')[$i-1]->categoria->id)
        
                <div class="row pt-4 px-lg-1 px-md-2 px-sm-1">
                    <div class="col">
                        <h3>
                            {{ $selecaos[$i]->categoria->nome }}
                        </h3>
                    </div>
                    <div class="col-lg-2 col-3 text-lg-center text-sm-right">
                        <button type="button" class="btn btn-outline-dark m-0 py-0 px-1" title="Adicionar item">
                            <i class="fas fa-plus"></i>
                        </button> 

                        <a type="submit" class="btn btn-outline-danger m-0 py-0 px-1" title="Remover categoria e todos os ítens contidos nela" onclick="event.preventDefault();
                        document.getElementById('delete-form{{ $selecaos[$i]->categoria->id }}').submit();"><i class="far fa-trash-alt"></i></a>
                        <form id="delete-form{{ $selecaos[$i]->categoria->id }}" action="{{ route('cardapios_delete_categoria', ['cardapio' => $cardapio, 'categoria' => $selecaos[$i]->categoria->id]) }}" method="POST" style="display: none;">
                            @method('delete')
                            @csrf
                        </form> 
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
            @endif
            @if ($selecaos[$i]->item_id != null)
                <li class="list-group-item">
                    <div class="row pl-2">
                        <div class="col">
                            {{ $selecaos[$i]->item->nome }}
                        </div>
                        <div class="col-1 text-left">
                            <button type="button" class="btn btn-outline-danger m-0 py-0 px-1" title="Remover ítem">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </li>   
            @endif
            @if ($i == $cardapio->selecaos->count() - 1 || $selecaos[$i]->categoria->id != $cardapio->selecaos->sortBy('categoria')[$i+1]->categoria->id)                             
                </ul>
            @endif
        @endfor
        
    
</div>

<!-- Add categoria Modal -->
<div class="modal fade" id="addCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="addCategoriaModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="addCategoriaModalModalLabel">Adicionar categoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('cardapios_select_categoria', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio]) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome da categoria:</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
  </div>

@endsection