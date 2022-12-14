//const { list } = require("postcss");

$(document).ready( function() {
    function updatePedidos(){
        $.ajax({
            type: "GET",
            url: `/pedido/admin/getpedidos/`,
            data: null,
            dataType: "json",
            success: function(response){
                console.log(response);
                printPedidos(response.return);
                // IMPLEMENTAR O Método para imprimir os pedidos no local correto
            },
            error: function(error){
                console.log(error);
            }
        });
    }
    function printPedidos(arrayPedidos){
        //Encontrar onde irá imprimir as informações
        const listPedidos = $("#list-pedidos");
        //Limpar o local que eu quero imprimir
        listPedidos.html("");
        //Interação de um array utilizando forEach
        arrayPedidos.forEach(pedido => {
            listPedidos.append(`<a href="#" class="list-group-item list-group-item-action">Pedido ${pedido.id}</a>`)

        });
    }

    function updateTipoProdutosDropdown(){
        $.ajax({
            type: "GET",
            url: `/pedido/admin/gettipoprodutos`,
            data: null,
            dataType:"json",
            sucess: function(response){
                printSelectTipoProdutos(response.return);
            },
            error: function(error){
                console.log(error)
            }
        })
    }
    function printSelectTipoProdutos(arrayTipoProdutos){

    }


    // Chama a função inicialmente quando carregar a página
    updatePedidos();
});

