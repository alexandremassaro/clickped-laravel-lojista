@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')
    <item-cadastro-component estabelecimento={{ $estabelecimento->slug }}></item-cadastro-component>
    <div class="row pt-4">
        <div class="col">
            <h1><span>Ítens de cardápio</span></h1>
        </div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-outline-dark" title="Adicionar novo ítem" data-toggle="modal" data-target="#addItemModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

        
    @foreach($estabelecimento->items->sortBy('status') as $item)
        <complemento-cadastro-component item="{{ $item->id }}" id="modalComplemento{{ $item->id }}" estabelecimento={{ $estabelecimento->slug }}></complemento-cadastro-component>
        
        <div id="accordionItems">
            <div class="card">
                <div class="card-header py-0" id="heading{{ $item->id }}">
                    <div class="row justify-content-between align-middle">
                        <h5 class=" my-1">
                            <button class="btn collapsed" data-toggle="collapse" data-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                {{ $item->nome }}
                            </button>
                        </h5>
                        <div>
                            <span class="badge badge-primary">@money($item->preco)</span>
                            <div class="btn-group btn-group-sm py-2" role="group">
                                
                                <button type="button" class="btn btn-outline-dark" title="Adicionar complemento" data-toggle="modal" data-target="#modalComplemento{{ $item->id }}">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button type="button" class="btn btn-outline-danger" title="Deletar item" onclick="document.getElementById('delete-form{{ $item->id }}').submit();">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                
                            </div>
                            <form id="delete-form{{ $item->id }}" action="{{ route('items_destroy', ['estabelecimento' => $estabelecimento, 'item' => $item]) }}" method="POST" style="display: none;">
                                @method('delete')
                                @csrf
                            </form> 
                        </div>
                    </div>
                </div>
          
                <div id="collapse{{ $item->id }}" class="collapse" aria-labelledby="heading{{ $item->id }}" data-parent="#accordionItems">
                    <div class="list-group list-group-flush">

                        @foreach ($item->complementos as $complemento)
                        <opcao-cadastro-component complemento="{{ $complemento->id }}" id="modalOpcao{{ $complemento->id }}" estabelecimento={{ $estabelecimento->slug }}></opcao-cadastro-component>
                            <div id="accordionComplemento">
                                <div class="list-group-item m-0 py-0">
                                    <div class="row justify-content-between px-1" id="headingComplemento{{ $complemento->id }}">
                                            <h5 class="m-0">
                                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseComplemento{{ $complemento->id }}" aria-expanded="false" aria-controls="collapseComplemento{{ $complemento->id }}">
                                                    {{ $complemento->nome }}
                                                </button>
                                            </h5>
                                            <div class="btn-group btn-group-sm py-1" role="group">
                                                
                                                <button type="button" class="btn btn-outline-dark" title="Adicionar opção" data-toggle="modal" data-target="#modalOpcao{{ $complemento->id }}">
                                                    <i class="fas fa-plus"></i>
                                                </button> 
                                                <button type="button" class="btn btn-outline-danger" title="Deletar complemento" onclick="document.getElementById('delete-complemento-form{{ $complemento->id }}').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                
                                            </div>
                                            <form id="delete-complemento-form{{ $complemento->id }}" action="{{ route('complementos_destroy', ['estabelecimento' => $estabelecimento, 'complemento' => $complemento]) }}" method="POST" style="display: none;">
                                                @method('delete')
                                                @csrf
                                            </form> 
                                    </div>
                            
                                    <div id="collapseComplemento{{ $complemento->id }}" class="collapse" aria-labelledby="headingComplemento{{ $complemento->id }}" data-parent="#accordionComplemento">
                                        <ul class="list-group list-group-flush mx-2 py-2">
                                            @foreach ($complemento->opcaos as $opcao)
                                                <li class="list-group-item d-flex justify-content-between align-items-center m-0 p-0">
                                                    {{ $opcao->nome }}
                                                    <div>
                                                        <span class="badge badge-primary">@money($opcao->preco)</span>
                                                        <div class="btn-group btn-group-sm pl-2" role="group" aria-label="...">
                                                            <button type="button" class="btn btn-outline-danger" title="Deletar opção" onclick="document.getElementById('delete-opcao-form{{ $opcao->id }}').submit();">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                        <form id="delete-opcao-form{{ $opcao->id }}" action="{{ route('opcaos_destroy', ['estabelecimento' => $estabelecimento, 'opcao' => $opcao]) }}" method="POST" style="display: none;">
                                                            @method('delete')
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>            
          </div>
    @endforeach
</div>

@endsection