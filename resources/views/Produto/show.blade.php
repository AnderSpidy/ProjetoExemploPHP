<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show de Produto</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" value={{$produtos->id}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" value={{$produtos->nome}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Preço</label>
            <input type="text" class="form-control" value={{$produtos->preco}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Descrição</label>
            <input type="text" class="form-control" value={{$produtos->descricao}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Ingredientes</label>
            <input type="text" class="form-control" value={{$produtos->ingredientes}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">urlImage</label>
            <input type="text" class="form-control" value={{$produtos->urlImage}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Updated_At</label>
            <input type="text" class="form-control" value={{$produtos->updated_at}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Created_At</label>
            <input type="text" class="form-control" value={{$produtos->created_at}} disabled>
        </div>


        <p>{{$produtos->id}}</p>
        <p>{{$produtos->nome}}</p>
        <p>{{$produtos->preco}}</p>
        <p>{{$produtos->descricao}}</p>
        <p>{{$produtos->ingredientes}}</p>
        <p>{{$produtos->urlImage}}</p>
        <p>{{$produtos->updated_at}}</p>
        <p>{{$produtos->created_at}}</p>
        <div class="m-3">
            <a href="{{route("produto.index")}}" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</body>
</html>
