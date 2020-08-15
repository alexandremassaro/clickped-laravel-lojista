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
                                Categorias
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ route('categorias_store', ['estabelecimento' => $estabelecimento]) }}" method="POST">
                                @csrf
                                <input type="text" class="form-control form-control-sm" id="nome" name="nome" placeholder="Adiciona nova categoria">
                                <button type="submit" class="d-none"></button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-8">Nome da categoria</th>
                                    <th scope="col" class="col-1 text-center">Editar</th>
                                    <th scope="col" class="col-1 text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estabelecimento->categorias as $categoria)
                                @if ($categoria->status == 0)
                                    
                                <tr>
                                    <td>{{ $categoria->nome }}</td>
                                    <td class="text-center"><button class="btn btn-outline-dark py-0 px-1" style="width: 1.5rem; height: 1.5rem" data-toggle="modal" data-target="#modal_editar_categoria{{ $categoria->id }}"><i class="far fa-edit"></i></button></td>
                                    <td class="text-center">
                                        <form action="{{ route('categorias_destroy', ['estabelecimento' => $estabelecimento, 'categoria' => $categoria]) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger py-0 px-1" style="width: 1.5rem; height: 1.5rem"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12 d-flex justify-content-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($estabelecimento->categorias as $categoria)
{{-- Modal editar categoria --}}
<div class="modal fade" id="modal_editar_categoria{{ $categoria->id }}" tabindex="-1" aria-labelledby="modal_editar_categoria{{ $categoria->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_editar_categoria{{ $categoria->id }}Label">Categoria - {{ $categoria->nome }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categorias_update', ['estabelecimento' => $estabelecimento, 'categoria' => $categoria]) }}" method="POST">
                @method('patch')
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome da categoria:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ $categoria->nome }}">
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


@endforeach



@endsection