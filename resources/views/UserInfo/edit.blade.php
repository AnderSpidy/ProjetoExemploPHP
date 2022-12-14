<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit userinfo</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="{{route("userinfo.update", $userInfo->Users_id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id-input-id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id-input-id" aria-describedby="idHelp" placeholder="#" value="{{$userInfo->Users_id}}" disabled>
                <div id="id" class="form-text">Não será necessário cadastrar um id</div>
            </div>
            <div class="form-group">
                <label for="id-input-profileImg" class="form-label">Profile Img</label>
                <input name="profileImg" type="text" class="form-control" id="id-input-profileImg" placeholder="Digite o profileImg" value="{{$userInfo->profileImg}}" required>
            </div>
            <div class="form-group">
                <label for="id-input-status" class="form-label">Status</label>
                <input type="text" class="form-control" id="id-input-status" placeholder="#" value="{{$userInfo->status}}" disabled>
            </div>
            <div class="form-group">
                <label for="id-input-dataNasc" class="form-label">dataNasc</label>
                <input name="dataNasc" type="text" class="form-control" id="id-input-dataNasc" placeholder="Digite os dataNasc" value="{{$userInfo->dataNasc}}" required>
            </div>
            <div class="form-group">
                <label for="id-input-genero" class="form-label">Genero</label>
                <input name="genero" type="text" class="form-control" id="id-input-genero" placeholder="Digite a genero" value="{{$userInfo->genero}}" required>
            </div>
            <div class="my-1">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{route("userinfo.show", $userInfo->Users_id)}}" class="btn btn-primary"></a>
            </div>
          </form>
    </div>
</body>
</html>
