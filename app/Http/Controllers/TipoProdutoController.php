<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\DB;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mostra uma lista com todos os recursos cadastrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM TIPO_PRODUTOS e armazenando o resultado no objeto $tipoProdutos
        // Esse objeto é um vetor de models
        //$tipoProdutos = TipoProduto::all();
        $tipoProdutos = DB::select('SELECT * FROM TIPO_PRODUTOS');
        //print_r($tipoProdutos);
        return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos);
    }

    /**
     * Show the form for creating a new resource.
     * Mostrar um formulário para criação de um novo recurso
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("TipoProduto/create");
    }

    /**
     * Store a newly created resource in storage.
     * Armazena um recurso recém criado na base de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoProduto = new TipoProduto();
        $tipoProduto->descricao = $request->descricao;
        $tipoProduto->save();
        return $this->index();
    }

    public function show($id)
    {
        // O DB Select sempre retorna um array [obj], [obj,obj,obj,.....] oi []
         $tipoProdutos = DB::select("SELECT TIPO_PRODUTOS.id,
                                 TIPO_PRODUTOS.descricao,
                                 TIPO_PRODUTOS.updated_at,
                                 TIPO_PRODUTOS.created_at
                            FROM TIPO_PRODUTOS
                            WHERE TIPO_PRODUTOS.id = ?", [$id]);
        //$produto = Produto::find($id); //Retorna um objeto ou NUll
        //dd($produto);

        //é cadrrgado a view de Produto, criando dentro dela um objeto chamando "produto" com o conteudo de
        //$produto que esta no controldor
        if(count($tipoProdutos) > 0)
            return view("TipoProduto/show")->with("tipoProdutos",$tipoProdutos[0]);
        echo "Produto não encontrado";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoProduto = TipoProduto::find($id); //retorna obj ou null
        //Se o obj é valido ou null
        if(isset($tipoProduto)){
            return view("TipoProduto/edit")->with("tipoProduto",$tipoProduto);
        }else{
            //TODO implementar tratamento de exceptions
            echo "Produto não encontrado";
        }
    }

    public function update(Request $request, $id)
    {
       $tipoProduto = TipoProduto::find($id);

       if(isset($tipoProduto)){
           $tipoProduto->descricao = $request->descricao;
           $tipoProduto->update();
           //Recarregar a view index
           return $this->index();
       }
       // Tratar exceptions futuramente
       echo "Tipo de produto não encontrado";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
