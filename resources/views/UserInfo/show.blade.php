<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show de UserInfo</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        {{-- <a class="btn btn-primary" href="{{redirect()->route("userInfo.edit")->with("userInfo",$userInfo)}}">Editar</a> --}}
        <a  class="btn btn-danger class-button-destroy" data-bs-toggle="modal" data-bs-target="#destroyModal" href="{{route("userinfo.destroy",1)}}">Excluir</a>
        <div class="form-group">
            <label for="id-input-id">ID</label>
            <input type="text" class="form-control" value={{$userInfo->Users_id}} disabled>
        </div>
        <div class="form-group">
            <label for="id-input-descricao">profileImg</label>
            <input type="text" class="form-control" value={{$userInfo->profileImg}} disabled>
        </div>
        <div class="form-group">
            <label for="id-input-id">Status</label>
            <input type="text" class="form-control" value={{$userInfo->status}} disabled>
        </div>

        <div class="form-group">
            <label for="id-input-descricao">dataNasc</label>
            <input type="text" class="form-control" value={{$userInfo->dataNasc}} disabled>
        </div>

        <div class="form-group">
            <label for="id-input-descricao">Genero</label>
            <input type="text" class="form-control" value={{$userInfo->genero}} disabled>
        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="destroyModalLabel">Confirmação de Remoção:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Deseja realmente remover este recurso?
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary">Confirmar Remoção</button> --}}
                <form id="id-form-modal-botao-remover" action="/produto/4" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Confirmar Remoção">
            </div>
        </div>
        </div>
    </div>

    <script>
        const arrayBtnRemover = document.querySelectorAll(".class-button-destroy");
        const formModalBotaoRemover = document.querySelector("#id-form-modal-botao-remover")
        console.log(arrayBtnRemover);
        arrayBtnRemover.forEach(btnRemover => {
            btnRemover.addEventListener("click", configurarBotaoRemoverModal);
        });
        function configurarBotaoRemoverModal(){
            //Imprimindo o conteudo do atributo value do botão que chamou essa função
            console.log(this.getAttribute("value"));
            formModalBotaoRemover.setAttribute("action", this.getAttribute("value"));
        }
    </script>

</body>
</html>
