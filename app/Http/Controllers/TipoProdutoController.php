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
        try{
            // SELECT * FROM TIPO_PRODUTOS e armazenando o resultado no objeto $tipoProdutos
        // Esse objeto é um vetor de models
        //$tipoProdutos = TipoProduto::all();
        $tipoProdutos = DB::select('SELECT * FROM TIPO_PRODUTOS');
        //print_r($tipoProdutos);
        }catch(\Throwable $th){
            return $this ->indexMessage([$th -> getMessage(),"danger"]);
        }
        return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos);
    }

    public function indexMessage($message)
    {
        try{
            $tipoProdutos = DB::select('SELECT * FROM TIPO_PRODUTOS');
        } catch (\Throwable $th){
            return view("TipoProduto/index")->with("tipoProdutos", [])->with("message", [$th->getMessage(), "danger"]);
        }
        // redirect('/produto');
        return view("TipoProduto/index")->with("tipoProdutos", $tipoProdutos)->with("message", $message);
    }
    public function create()
    {
        return view("TipoProduto/create");
    }

    public function store(Request $request)
    {
        try{
            $tipoProduto = new TipoProduto();
            $tipoProduto->descricao = $request->descricao;
            $tipoProduto->save();

        }catch(\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        }

        return $this->indexMessage(["TipoProduto cadastrado com sucesso", "sucesso"]);
    }

    public function show($id)
    {
        try{
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
            if(count($tipoProdutos) > 0){
                return view("TipoProduto/show")->with("tipoProdutos",$tipoProdutos[0]);
            }else{
                return $this->indexMessage(["TipoProduto não encontrado", "warning"]);
            }

        }catch(\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        }
    }

    public function edit($id)
    {
        try{
            $tipoProduto = TipoProduto::find($id); //retorna obj ou null
            //Se o obj é valido ou null
            if(isset($tipoProduto)){
                return view("TipoProduto/edit")->with("tipoProduto",$tipoProduto);
            }else{
                return $this->indexMessage(["TipoProduto não encontrado", "warning"]);
            }
        }catch(\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $tipoProduto = TipoProduto::find($id);

            if(isset($tipoProduto)){
                $tipoProduto->descricao = $request->descricao;
                $tipoProduto->update();
                //Recarregar a view index
                return $this->indexMessage(["TipoProduto atualizado com sucesso", "success"]);
            }else{
                return $this->indexMessage(["TipoProduto não encontrado", "warning"]);
            }

        }catch(\Throwable $th){
            return $this->indexMessage([$th->getMessage(), "danger"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $tipoProduto = TipoProduto :: find($id); //Retirna o objeto, caso contrario retorna null
            //se existir
            if(isset($tipoProduto)){
                $tipoProduto -> delete();
                return $this-> indexMessage(["TipoProduto removido com sucesso", "success"]);

            }
             //Retorno do aviso, caso nao encontre o produto
             return $this-> indexMessage(["TipoProduto não foi encontrado", "warning"]);
        }catch(\Throwable $th){
            return $this-> indexMessage([$th -> getMessage(), "danger"]);
        }
    }
}
