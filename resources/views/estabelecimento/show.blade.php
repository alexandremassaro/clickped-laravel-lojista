@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')
    <div class="row justify-content-center">
        <div class="col py-4">
            <div class="card">
                <div class="card-header navbar">
                    <div class="row w-100 justify-content-between">
                        <div class="col-md-5">
                            <div class="h4 p-0 m-0">
                                Pedidos Recentes
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control form-control-sm">
                                <option>Mostrar todos</option>
                                <option>Pendentes</option>
                                <option>Preparando</option>
                                <option>Entregando</option>
                                <option>Finalizados</option>
                              </select>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="row justify-content-center">
                        <div class="col">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">Número</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Mesa</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Pedido</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Exibir</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < 10; $i++)
                                        <tr>
                                            <th scope="row">{{ $i+1 }}</th>
                                            <td>Pendente</td>
                                            <td>05</td>
                                            <td>João da SilvaJoão da SilvaJoão da SilvaJoão da SilvaJoão da SilvaJoão da SilvaJoão da SilvaJoão da SilvaJoão da Silva</td>
                                            <td>Heineken 600ml</td>
                                            <td>2</td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample_{{ $i }}" aria-expanded="false" aria-controls="collapseExample_{{ $i }}">
                                                    Ver
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="collapseExample_{{ $i }}">
                                            <td>
                                                Anim
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection