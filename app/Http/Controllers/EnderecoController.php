<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use App\Models\Endereco;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web'); // Especificando qual guarda estamos utilizando
    }
    public function index()
    {
        $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
        try {
            $enderecos = DB::select('SELECT * FROM Enderecos where Users_id = ?', [$logged->id]);
        } catch (\Throwable $th) {
            //throw $th;
            return view("Endereco/index")->with("enderecos", $enderecos)->with("message", [$th->getMessage(), "danger"]);
        }
        return view("Endereco/index")->with("enderecos", $enderecos);
    }

    public function indexMessage($message)
    {
        try {
            $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
            $enderecos = DB::select('SELECT * FROM Enderecos where Users_id = ?', [$logged->id]);
        } catch (\Throwable $th) {
            //throw $th;
            return view("Endereco/index")->with("enderecos", [])->with("message", $message);
        }
        return view("Endereco/index")->with("enderecos", $enderecos)->with("message", $message);
    }

    public function create()
    {
        try{
            $userInfos =DB::select("SELECT * FROM User_Infos");
        } catch(\Throwable $th){
            return $this->indexMessage( [$th->getMessage(), "danger"] );

        }
        return view("Endereco/create")->with("userInfos", $userInfos);
    }

    public function store(Request $request)
    {
        try {
            $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
            $endereco = new Endereco();
            $endereco->Users_id = $logged->id;
            $endereco->bairro = $request->bairro;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->save();
        } catch (\Throwable $th) {
            return $this->indexMessage([$th->getMessage(), "success"]);
        }
        return $this->indexMessage(["Endere??o cadastrado com sucesso", "success"]);
    }
    public function show($id)
    {
        try {
            $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
            // Faz a consulta utilizando o DB::select
            $enderecos = DB::select("SELECT * FROM ENDERECOS WHERE id = ? and Users_id = ?", [$id, $logged->id]); // SEMPRE RETORNA UM ARRAY [ obj ] ou []
            // Verifica se o endereco de $id foi encontrado
            if( count($enderecos) > 0 ) {
                // Retorno quando d?? certo
                return view("Endereco/show")->with("endereco", $enderecos[0]); // Retorna a posi????o 0, pois o array sempre ter?? 1 elemento
            }
            // Retorno quando falha no IF (Quando n??o encontra o ID pelo select)
            return $this->indexMessage(['O endere??o n??o foi encontrado', 'warning']);
        } catch (\Throwable $th) {
            return $this->indexMessage([$th->getMessage(), 'danger']);
        }
    }

    public function edit($id)
    {
        try {
            $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
            // Procuro o endereco que eu quero editar
            $endereco = Endereco::where('id', $id)->where('Users_id', $logged->id)->first(); // Retorna um objeto ou null (quando n??o ?? encontrado)
            if( isset($endereco) ) {
                // Retorno quando d?? certo
                return view("Endereco/edit")->with("endereco", $endereco);
            }
            // Retorno quando falha no IF (Quando n??o encontra o ID pelo find)
            return $this->indexMessage(['O endereco n??o foi encontrado', 'warning']);
        } catch (\Throwable $th) {
            return $this->indexMessage([$th->getMessage(), 'danger']);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
            // Procuro o endereco que eu quero editar
            $endereco = Endereco::where('id', $id)->where('Users_id', $logged->id)->first(); // Retorna um objeto ou null (quando n??o ?? encontrado)
            if( isset($endereco) ){
                //$endereco ?? do model
                //$request ?? do name na view
                $endereco->bairro = $request->bairro;
                $endereco->logradouro = $request->logradouro;
                $endereco->numero = $request->numero;
                $endereco->complemento = $request->complemento;
                $endereco->update();
                // Retorno quando d?? certo
                return $this->indexMessage(['Endere??o atualizado com sucesso', 'success']);
            }
            // Return quando n??o encontra o endereco para edi????o
            return $this->indexMessage(['O Endere??o n??o foi encontrado', 'warning']);
        } catch (\Throwable $th) {
            return $this->indexMessage([$th->getMessage(), 'danger']);
        }
    }

    public function destroy($id)
    {
        try {
            $logged = Auth::guard('web')->user(); // Retorna um objeto do Model User
            // Procuro o endereco que eu quero excluir
            $endereco = Endereco::where('id', $id)->where('Users_id', $logged->id)->first(); // Retorna um objeto ou null (quando n??o ?? encontrado)
            if( isset($endereco) ){
                // Remove o endereco
                $endereco->delete();
                // Retorno quando d?? certo
                return $this->indexMessage(['Endere??o removido com sucesso', 'success']);
            }
            // Retorno de aviso quando o endereco n??o foi encontrado
            return $this->indexMessage(['O endereco n??o foi encontrado', 'warning']);
        } catch (\Throwable $th) {
            // Retorno de erro
            return $this->indexMessage([$th->getMessage(), 'danger']);
        }
    }
}
