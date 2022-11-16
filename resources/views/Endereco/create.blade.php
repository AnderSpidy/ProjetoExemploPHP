<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create de Endereco</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
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
</body>
</html>
