<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use App\Models\TipoProduto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT * FROM TIPO_PRODUTOS e armazenando o resultado no objeto $tipoProdutos
        // Esse objeto é um vetor de models
        //$tipoProdutos = TipoProduto::all();
        $produtos = DB::select("SELECT PRODUTOS.ID as id,
                                PRODUTOS.NOME as nome,
                                    PRODUTOS.PRECO as preco,
                                    TIPO_PRODUTOS.DESCRICAO as descricao
                                FROM PRODUTOS
                                JOIN TIPO_PRODUTOS ON PRODUTOS.TIPO_PRODUTOS_ID = TIPO_PRODUTOS.ID;");

        return view("Produto/index")->with("produtos", $produtos);
    }

    public function create()
    {
        $tipoProdutos = DB::select("SELECT * FROM TIPO_PRODUTOS");
        return view("Produto/create") -> with("tipoProdutos", $tipoProdutos);
    }

    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
        $produto->ingredientes = $request->ingredientes;
        $produto->urlImage = $request->urlImage;

        $produto->save();
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // O DB Select sempre retorna um array [obj], [obj,obj,obj,.....] oi []
         $produtos = DB::select("SELECT PRODUTOS.id,
                                 PRODUTOS.nome,
                                 PRODUTOS.preco,
                                 Produtos.Tipo_Produtos_id,
                                 TIPO_PRODUTOS.descricao,
                                 Produtos.ingredientes,
                                 Produtos.urlImage,
                                 Produtos.updated_at,
                                 Produtos.created_at
                            FROM PRODUTOS
                            JOIN TIPO_PRODUTOS ON PRODUTOS.TIPO_PRODUTOS_ID = TIPO_PRODUTOS.ID
                            WHERE Produtos.id = ?", [$id]);
        //$produto = Produto::find($id); //Retorna um objeto ou NUll
        //dd($produto);

        //é cadrrgado a view de Produto, criando dentro dela um objeto chamando "produto" com o conteudo de
        //$produto que esta no controldor
        if(count($produtos) > 0)
            return view("Produto/show")->with("produtos",$produtos[0]);
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
        $produto = Produto::find($id); //retorna obj ou null
        //Se o obj é valido ou null
        if(isset($produto)){
            //Array com todos os TipoProdutos no BD
            $tipoProdutos = TipoProduto::all();
            return view("Produto/edit")
                ->with("produto",$produto)
                ->with("tipoProdutos",$tipoProdutos);
        }else{
            //TODO implementar tratamento de exceptions
            echo "Produto não encontrado";
        }
    }

    public function update(Request $request, $id)
    {
        //echo "Tipo $request->Tipo_Produtos_id";
        $produto = Produto::find($id);

        //Dentro dessa variavel eu já tenho o produto que eu quero attualizar

        //Pergunto se o obj é valido ou null (se ele existe)
        if(isset($produto)){
            $produto->nome = $request->nome;
            $produto->preco = $request->preco;
            $produto->Tipo_Produtos_id = $request->Tipo_Produtos_id;
            $produto->ingredientes = $request->ingredientes;
            $produto->urlImage = $request->urlImage;
            $produto->update();
            //Recarregar a view index
            return $this->index();
        }
        // Tratar exceptions futuramente
        echo "Produto não encontrado";


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
