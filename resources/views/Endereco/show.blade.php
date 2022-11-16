<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show de Endereco</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" value={{$endereco->id}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Users_id</label>
            <input type="text" class="form-control" value={{$endereco->users_id}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Bairro</label>
            <input type="text" class="form-control" value={{$endereco->bairro}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Logradouro</label>
            <input type="text" class="form-control" value={{$endereco->logradouro}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Número</label>
            <input type="text" class="form-control" value={{$endereco->numero}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Complemento</label>
            <input type="text" class="form-control" value={{$endereco->complemento}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Updated_At</label>
            <input type="text" class="form-control" value={{$endereco->updated_at}} disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Created_At</label>
            <input type="text" class="form-control" value={{$endereco->created_at}} disabled>
        </div>

        <div class="m-3">
            <a href="{{route("endereco.index")}}" class="btn btn-primary">Voltar</a>
        </div>
    </div>

</body>
</html>
