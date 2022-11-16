
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Endereco</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="{{route("endereco.update", $endereco->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="idHelp" placeholder="#" value="{{$endereco->id}}" disabled>
                <div id="id" class="form-text">Não será necessário cadastrar um id</div>
            </div>
            <div class="form-group">
                <label for="id-input-bairro" class="form-label">Bairro</label>
                <input name="bairro" type="text" class="form-control" id="id-input-bairro" placeholder="Digite o bairro" value="{{$endereco->bairro}}" required>
            </div>
            <div class="form-group">
                <label for="id-input-logradouro" class="form-label">Logradouro</label>
                <input name="logradouro" type="text" class="form-control" id="id-input-logradouro" placeholder="Digite o logradouro" value="{{$endereco->logradouro}}" required>
            </div>

            <div class="form-group">
                <label for="id-input-numero" class="form-label">Número</label>
                <input name="numero" type="number" class="form-control" id="id-input-numero" placeholder="Digite o numero" value="{{$endereco->numero}}" required>
            </div>
            <div class="form-group">
                <label for="id-input-complemento" class="form-label">Complemento</label>
                <input name="complemento" type="text" class="form-control" id="id-input-complemento" placeholder="Digite ao complemento" value="{{$endereco->complemento}}" required>
            </div>
            <div class="my-1">
                <a href="{{route("endereco.index")}}" class="btn btn-primary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
    </div>
</body>
</html>
