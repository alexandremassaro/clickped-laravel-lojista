@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Deseja cadastrar seu estabelecimento?</div>

                <div class="card-body">

                    <form action=" {{ route('estabelecimento.store') }} " method="post" enctype="multipart/form-data">
                        @csrf

                        
                        <div class="form-group">
                            <label for="razao_social">Razão Social</label>
                            <input type="text" name="razao_social" value="{{ old('razao_social') ?? $estabelecimento->razao_social }}" class="form-control">
                        </div>
                        <div class="pb-3">{{ $errors->first('razao_social') }}</div>
                        
                        <div class="form-group">
                            <label for="nome_fantasia">Nome Fantasia</label>
                            <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia') ?? $estabelecimento->nome_fantasia }}" class="form-control">
                        </div>
                        <div class="pb-3">{{ $errors->first('nome_fantasia') }}</div>

                        <div class="form-group">
                            <label for="cpf">CNPJ</label>
                            <input type="text" name="cnpj" value="{{ old('cnpj') ?? $estabelecimento->cnpj }}" class="form-control">
                        </div>
                        <div class="pb-3">{{ $errors->first('cpf') }}</div>
                        
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection