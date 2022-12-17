<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('PedidoAdmin/index');
    }
    public function getPedidoProdutos($id){
        //SELECT Tipo_Produtos.descricao,Produtos.nome,Pedido_Produtos.quantidadeFROM Pedido_ProdutosINNER JOIN Produtos ON Pedido_Produtos.Produtos_id = Produtos.idINNER JOIN Tipo_Produtos ON Produtos.Tipo_Produtos_id = Tipo_Produtos.id = ?"[$id]);
            $produtos = DB::select("SELECT Pedidos_id,
                                    Produtos_id,
                                    quantidade,
                                    nome,
                                    preco,
                                    Tipo_Produtos_id,
                                    ingredientes,
                                    urlImage,
                                    descricao
                                FROM pedido_produtos
                                INNER JOIN produtos
                                ON pedido_produtos.Produtos_id = produtos.id
                                INNER JOIN tipo_produtos
                                ON produtos.Tipo_Produtos_id = tipo_produtos.id
                                WHERE pedido_produtos.Pedidos_id = ?", [$id]);
            $response["success"] = true;
            $response["message"] = "Consulta de tipo realizada com sucesso";
            $response["return"] = $produtos;
            return response()->json($response, 200);
    }

    public function getProdutos($id){
        $produtos = DB::select("SELECT * FROM Produtos WHERE Produtos.Tipo_Produtos_id = ?", [$id]);
        $response["success"] = true;
        $response["message"] = "Consulta de tipo realizada com sucesso";
        $response["return"] = $produtos;
        return response()->json($response, 200);
    }


    public function getPedidos()
    {
        // Não esquecer de dar use na classe DB
        // use Illuminate\Support\Facades\DB;
        $pedidos = DB::select('SELECT * FROM Pedidos ORDER BY Pedidos.id DESC');
        // Crio a variável response que será enviada para o front-end
        $response["success"] = true;
        $response["message"] = "Consulta de tipo realizada com sucesso";
        $response["return"] = $pedidos;
        return response()->json($response, 200);
    }
    public function getTipoProdutos(){
        $tipoProdutos = DB::select("SELECT * FROM Tipo_Produtos");
        $response["success"] = true;
        $response["message"] = "Consulta realizada com sucesso";
        $response["return"] = $tipoProdutos;
        return response()->json($response,200);
    }

}
