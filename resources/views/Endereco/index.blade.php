<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index de Endereco</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        {{-- <?php $message = [ "Texto a ser exibido", "warning" ] ?> --}}
        @if(isset($message))
            <div class="alert alert-{{$message[1]}} alert-dismissible fade show" role="alert">
                <span>{{$message[0]}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a class="btn btn-primary" href="{{route("endereco.create")}}">Criar Endereco</a>
        <a class="btn btn-primary" href="#">Voltar</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Logradouro</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Complemento</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($enderecos as $endereco)
                    <tr>
                        <th scope="row">{{$endereco->id}}</th>
                        <td>{{$endereco->bairro}}</td>
                        <td>{{$endereco->logradouro}}</td>
                        <td>{{$endereco->numero}}</td>
                        <td>{{$endereco->complemento}}</td>
                        <td>
                            <a href="{{route("endereco.show", $endereco->id)}}" class="btn btn-primary">Mostrar</a>
                            <a href="{{route("endereco.edit", $endereco->id)}}" class="btn btn-secondary">Editar</a>
                            <a href="#"
                            class="btn btn-danger class-button-destroy"
                            data-bs-toggle="modal"
                            data-bs-target="#destroyModal"
                            value="{{route("endereco.destroy", $endereco->id)}}">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                <form id="id-form-modal-botao-remover" action="/endereco/4" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Confirmar Remoção" >
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
