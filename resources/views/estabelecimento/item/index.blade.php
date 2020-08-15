@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')
    <div class="row pt-4">
        <div class="col">
            <h1><span>Ítens de cardápio</span></h1>
        </div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-outline-dark" title="Adicionar novo ítem" data-toggle="modal" data-target="#addCategoriaModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

        
        @foreach($estabelecimento->items->sortBy('status') as $item)
        <item-cadastro-component component_route="{{ route('complemento_store') }}" item="{{ $item->id }}" id="modalComplemento{{ $item->id }}" estabelecimento={{ $estabelecimento->slug }}></item-cadastro-component>
        
            <div class="row pt-4 px-lg-1 px-md-2 px-sm-1">
                <div class="col">
                    <h3 title="{{ $item->descricao }}">
                        {{ $item->nome }}
                    </h3>
                </div>
                <div class="col-lg-2 col-3 text-lg-center text-sm-right">
                    <button type="button" class="btn btn-outline-dark m-0 py-0 px-1" title="Adicionar complemento" data-toggle="modal" data-target="#modalComplemento{{ $item->id }}">
                        <i class="fas fa-plus"></i>
                    </button>
                    

                    <a type="submit" class="btn btn-outline-danger m-0 py-0 px-1" title="Excluir ítem" onclick="event.preventDefault();
                    document.getElementById('delete-form{{ $item->id }}').submit();"><i class="far fa-trash-alt"></i></a>
                    <form id="delete-form{{ $item->id }}" action="{{ route('items_destroy', ['estabelecimento' => $estabelecimento, 'item' => $item]) }}" method="POST" style="display: none;">
                        @method('delete')
                        @csrf
                    </form> 
                </div>
            </div>
                
            <ul class="list-group list-group-flush">
            
            @foreach ($item->complementos as $complemento)
                
            
                <li class="list-group-item">
                    <div class="row pl-2">
                        <div class="col">
                            {{ $complemento->nome }}
                        </div>
                        <div class="col-1 text-left">
                            <button type="button" class="btn btn-outline-dark m-0 py-0 px-1" title="Adicionar opção">
                                <i class="fas fa-plus"></i>
                            </button> 
                            <button type="button" class="btn btn-outline-danger m-0 py-0 px-1" title="Remover complemento">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                    @foreach ($complemento->opcaos as $opcao)
                        <li class="list-group-item">
                            <div class="row pl-2">
                                <div class="col">
                                    {{ $opcao->nome }}
                                </div>
                                <div class="col-1 text-left">
                                    <button type="button" class="btn btn-outline-danger m-0 py-0 px-1" title="Remover opção">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    
                    @endforeach
                    </ul>
                </li>   
            
            @endforeach
            </ul>
            
        @endforeach
        
    
</div>

<!-- Add complemento Modal -->
<!-- Modal -->
<div class="modal fade" id="complemento1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
            

    

@endsection