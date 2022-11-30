@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route("endereco.store")}}">
            @csrf
            <div class="form-group">
                <label for="id-input-id">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="idHelp" placeholder="#" disabled>
                <small id="idHelp" class="form-text text-muted">Não é necessário informar o ID para cadastrar um novo dado.</small>
            </div>
            <div class="form-group">
                <label for="id-input-bairro">Bairro</label>
                <input name="bairro" type="text" class="form-control" id="id-input-bairro" placeholder="Digite o bairro">
            </div>
            <div class="form-group">
                <label for="id-input-logradouro">Logradouro</label>
                <input name="logradouro" type="text" class="form-control" id="id-input-logradouro" placeholder="Digite o logradouro">
            </div>

            <div class="form-group">
                <label for="id-input-numero">Numero</label>
                <input name="numero" type="number" class="form-control" id="id-input-numero" placeholder="Digite o Numero">
            </div>

            <div class="form-group">
                <label for="id-input-complemento">Complemento</label>
                <input name="complemento" type="text" class="form-control" id="id-input-complemento" placeholder="Digite os complemento do endereco">
            </div>

            <div class="my-1">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{route("endereco.index")}}">Voltar</a>
            </div>
        </form>
    </div>
@endsection
