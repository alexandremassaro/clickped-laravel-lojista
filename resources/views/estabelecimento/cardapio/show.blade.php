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

        @php
            $lastSelecao = null;
        @endphp

        @foreach($selecaos as $selecao)
            @if ($loop->first || $selecao->categoria->id != $lastSelecao->categoria->id)
                @if(!$loop->first)
                    </ul>
                @endif
                <item-select-component 
                    id="selecionaItemModal{{ $selecao->categoria->id }}" 
                    form_action="{{ route('cardapios_select_item', ['estabelecimento' => $estabelecimento, 'cardapio' => $cardapio, 'categoria' => $selecao->categoria]) }}"
                    csrf_token="{{ csrf_token() }}"
                    estabelecimento="{{ $estabelecimento->slug }}"
                    cardapio="{{ $cardapio->id }}"
                    categoria="{{ $selecao->categoria->id }}">
                </item-select-component>
        
                <div class="row pt-4 px-lg-1 px-md-2 px-sm-1">
                    <div class="col">
                        <h3>
                            {{ $selecao->categoria->nome }}
                        </h3>
                    </div>
                    <div class="col-lg-2 col-3 text-lg-center text-sm-right">
                        <button type="button" class="btn btn-outline-dark m-0 py-0 px-1" title="Adicionar item" data-toggle="modal" data-target="#selecionaItemModal{{ $selecao->categoria->id }}">
                            <i class="fas fa-plus"></i>
                        </button> 

                        <a type="submit" class="btn btn-outline-danger m-0 py-0 px-1" title="Remover categoria" onclick="event.preventDefault();
                        document.getElementById('delete-categoria-form{{ $selecao->categoria->id }}').submit();"><i class="far fa-trash-alt"></i></a>
                        <form id="delete-categoria-form{{ $selecao->categoria->id }}" action="{{ route('cardapios_delete_categoria', ['cardapio' => $cardapio, 'categoria' => $selecao->categoria->id]) }}" method="POST" style="display: none;">
                            @method('delete')
                            @csrf
                        </form> 
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
            @endif
            @if ($selecao->item_id)
                <li class="list-group-item">
                    <div class="row pl-2">
                        <div class="col">
                            {{ $selecao->item->nome ?? '' }}
                        </div>
                        <div class="col-1 text-left">
                            <button type="button" class="btn btn-outline-danger m-0 py-0 px-1" title="Remover ítem" onclick="document.getElementById('delete-item{{ $selecao->item->id }}-categoria{{$selecao->categoria->id}}-form').submit();">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <form id="delete-item{{ $selecao->item->id }}-categoria{{$selecao->categoria->id}}-form" action="{{ route('cardapios_delete_item', ['cardapio' => $cardapio, 'categoria' => $selecao->categoria->id, 'item' => $selecao->item->id]) }}" method="POST" style="display: none;">
                                @method('delete')
                                @csrf
                            </form> 
                        </div>
                    </div>
                </li>   
            @endif
            @if ($loop->last)                             
                </ul>
            @endif
            @php
                $lastSelecao = $selecao;
            @endphp
        @endforeach
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
                        <auto-complete-categoria estabelecimento="{{ $estabelecimento->slug }}" cardapio="{{ $cardapio->id }}"></auto-complete-categoria>
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