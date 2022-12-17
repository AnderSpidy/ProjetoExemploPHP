$(document).ready( function() {
    function groupBy(arr, property){
        return arr.reduce( function (anterior, atual){
            if(!anterior[atual[property]]){
                anterior[atual[property]] = [];
            }
            anterior[atual[property]].push(atual);
            return anterior;
        }, [] );
    }
    function updatePedidos() {
        $.ajax({
            type: "GET",
            url: `/pedido/admin/getpedidos/`,
            data: null,
            dataType: "json",
            success: function(response){
                //agrupa pela propriedade id
                agrupamentPedido = groupBy(response.return, "id");
                printPedidosEstatus(agrupamentPedido);

                $(".list-group-item").on("click", function(){
                    updatePedidoProdutos(this.getAttribute("value"));
                });

                updatePedidoProdutos(response.return[response.return.length-1].id);
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function printPedidosEstatus(agrupamentPedido){
        const listaPedidos = $("#list-pedidos");

        listaPedidos.html("");
        agrupamentPedido.forEach(TipoPedidos => {
            if(TipoPedidos[0].status == 'A') {
                listaPedidos.append(`
                    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" value="${TipoPedidos[0].id}">
                        Pedido ${TipoPedidos[0].id}
                    </a>
                `);
            }
            if(TipoPedidos[0].status == 'R') {
                listaPedidos.append(`
                    <a href="#" class="list-group-item list-group-item-action list-group-item-warning" value="${TipoPedidos[0].id}">
                        Pedido ${TipoPedidos[0].id}
                    </a>
                `);
            }
            if(TipoPedidos[0].status == 'C') {
                listaPedidos.append(`
                    <a href="#" class="list-group-item list-group-item-action list-group-item-danger" value="${TipoPedidos[0].id}">
                        Pedido ${TipoPedidos[0].id}
                    </a>
                `);
            }
            if(TipoPedidos[0].status == 'E') {
                listaPedidos.append(`
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary" value="${TipoPedidos[0].id}">
                        Pedido ${TipoPedidos[0].id}
                    </a>
                `);
            }
            if(TipoPedidos[0].status == 'F') {
                listaPedidos.append(`
                    <a href="#" class="list-group-item list-group-item-action list-group-item-success" value="${TipoPedidos[0].id}">
                        Pedido ${TipoPedidos[0].id}
                    </a>
                `);
            }
        });
    }

    //Função para rodar quando a pagina for carregada pela primeria vez  e reimprimir caso precise


    function updateTipoProdutosDropDown() {
        $.ajax({
            type: "GET",
            url: `/pedido/admin/gettipoprodutos/`,
            data: null,
            dataType: "json",
            success: function (response) {
                printSelectTipoProdutos(response.return);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function printSelectTipoProdutos(produtos_group) {
        divListProdutos = $("#lista-tipo-produtos");

        divListProdutos.html("");
        produtos_group.forEach(produtos_tipo => {
            divListProdutos.append(`
                <option value="${produtos_tipo.id}">${produtos_tipo.descricao}</option>
            `);
        });
    }

    function updateProdutosDropdown(tipoSelecionado) {
        const tipoProdutoId = tipoSelecionado;
        $.ajax({
            type: "GET",
            url: `/pedido/admin/getprodutos/${tipoProdutoId}`,
            data: null,
            dataType: "json",
            success: function(response){
                printSelectProdutos(response.return);
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function printSelectProdutos(produtos_group) {
        divListProdutos = $("#lista-produtos");

        divListProdutos.html("");
        produtos_group.forEach(produtos => {
            divListProdutos.append(`
                <option value="${produtos.id}">${produtos.nome}</option>
            `);
        });
    }

    function updatePedidoProdutos(idPedido){
        $.ajax({
            type: "GET",
            url: `/pedido/admin/getpedidoprodutos/${idPedido}`,
            data: null,
            dataType: "json",
            success: function(response){
                printListPedidoProdutos(response.return);

                $(".text-center").html(`Pedido ${idPedido}`);
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function printListPedidoProdutos(pedido_produtos_group){
        divListProdutos = $("#list-pedido-produtos");

        divListProdutos.html("");
        pedido_produtos_group.forEach(pedido_produtos => {
            divListProdutos.append(`
                    <span class="list-group-item">
                    ${pedido_produtos.descricao} -  ${pedido_produtos.nome} -  ${pedido_produtos.quantidade}x
                        <span class="class-icons-produto-list">
                            <i class="fa-solid fa-pencil-square"></i>
                            <i class="fa-solid fa-trash"></i>
                        </span>
                    </span>
            `);
        });
    }

    const selectFiltroTipo = $("#lista-tipo-produtos");
    selectFiltroTipo.on("change", function () {
        updateProdutosDropdown(selectFiltroTipo.val());
    });

    updateTipoProdutosDropDown();
    updateProdutosDropdown(1);
    updatePedidos();
});
