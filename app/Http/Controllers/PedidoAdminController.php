<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index()
    {
        return view('PedidoAdmin/index');
    }

    public function getPedidos($id)
    {

        $pedidos = DB::select('SELECT * FROM Pedidos ORDER BY Pedidos.id DESC');
        //Cria a variavel response que será enviada para o front-end
        
        $response["success"] = true;
        $response["message"] = "Consulta realizada com sucesso";
        $response["return"] = $produtos;
        return response()->json($response,200);

    }
}
