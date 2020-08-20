@extends('layouts.app')

@section('content')
<div class="container">
    @include('estabelecimento.layouts.nav.nav')
    <div class="row justify-content-center">
        <div class="col py-4">
            <pedidos-recentes-component estabelecimento="{{ $estabelecimento->slug }}"></pedidos-recentes-component>
        </div>
    </div>
</div>
@endsection