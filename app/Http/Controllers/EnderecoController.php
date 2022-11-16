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
        try{

        $enderecos = DB::select("SELECT ENDERECOS.ID as id,
                                        USER_INFOS.USERS_ID as users_id,
                                        ENDERECOS.BAIRRO as bairro,
                                        ENDERECOS.LOGRADOURO as logradouro,
                                        ENDERECOS.NUMERO as numero,
                                        ENDERECOS.COMPLEMENTO as complemento,
                                        ENDERECOS.updated_at,
                                        ENDERECOS.created_at
                                FROM ENDERECOS
                                JOIN USER_INFOS ON ENDERECOS.USERS_ID = USER_INFOS.USERS_ID;");
        }catch(\Throwable $th){
        return view("Endereco/index")->with("enderecos", [])->with("message", [$th->getMessage(), "danger"]);
        }
        return view("Endereco/index")->with("enderecos", $enderecos);
    }

    public function indexMessage($message)
    {
        try{
            $enderecos = DB::select("SELECT ENDERECOS.ID as id,
                                        USER_INFOS.USERS_ID as users_id,
                                        ENDERECOS.BAIRRO as bairro,
                                        ENDERECOS.LOGRADOURO as logradouro,
                                        ENDERECOS.NUMERO as numero,
                                        ENDERECOS.COMPLEMENTO as complemento,
                                        ENDERECOS.updated_at,
                                        ENDERECOS.created_at
                                FROM ENDERECOS
                                JOIN USER_INFOS ON ENDERECOS.USERS_ID = USER_INFOS.USERS_ID;");
        } catch (\Throwable $th){
            dd($th);
            return view("Endereco/index")->with("enderecos", [])->with("message", [$th->getMessage(), "danger"]);
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
        try{
            $endereco = new Endereco();
            $login = Auth::user();
            $endereco->Users_id = $login->id;
            $endereco->bairro = $request->bairro;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;

            $endereco->save();

        }catch (\Throwable $th) {

            // Mensagem de erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
        //Mensagem de sucesso
        return $this->indexMessage( ["Endereco cadastrado com sucesso", "success"] );
    }
    public function show($id)
    {
        try{
            $enderecos = DB::select("SELECT ENDERECOS.ID as id,
                                        USER_INFOS.USERS_ID as users_id,
                                        ENDERECOS.BAIRRO as bairro,
                                        ENDERECOS.LOGRADOURO as logradouro,
                                        ENDERECOS.NUMERO as numero,
                                        ENDERECOS.COMPLEMENTO as complemento,
                                        ENDERECOS.updated_at,
                                        ENDERECOS.created_at
                                FROM ENDERECOS
                                JOIN USER_INFOS ON ENDERECOS.USERS_ID = USER_INFOS.USERS_ID
                                WHERE Enderecos.id = ?", [$id]);

            // Verifica se encontrou o endereco
            if(count($enderecos) > 0) {
                // Retorno quando tudo está certo
                return view("Endereco/show")->with("endereco", $enderecos[0]);
            }
            // Retorno de aviso, endereco não encontrado
            return $this->indexMessage( ["Endereço não encontrado", "warning"] );
        } catch (\Throwable $th){
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }

    public function edit($id)
    {
        try {
            $endereco = Endereco::find($id); // retorna um obj ou null
            // Pergunto se o obj é válido ou null
            if( isset($endereco) ){

                return view("Endereco/edit")
                            ->with("endereco", $endereco);
            }else{
                dd($endereco);
                // Retorno de aviso, produto não encontrado
                return $this->indexMessage( ["Endereco não encontrado", "warning"] );
            }

        } catch (\Throwable $th) {
            // Retorno quando dá erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }
    public function update(Request $request, $id)
    {
        try{
            $endereco = Endereco::find($id);
        if( isset($endereco) ){
            $endereco->bairro = $request->bairro;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;

            $endereco->update();

            return $this->indexMessage( ["Endereco atualizado com sucesso", "success"] );

        }
        return $this->indexMessage( ["Endereco não encontrado", "warning"] );

        }catch (\Throwable $th) {
            // Retorno quando dá erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }

    public function destroy($id)
    {
        try {
            $endereco = Endereco::find($id); // Retorna o objeto encontrado ou null, caso ñ encontrado
            // Se o produto foi encontrado
            if( isset($endereco) ) {
                $endereco->delete();
                // return \Redirect::route('produto.index');
                // Retorno quando dá certo
                return $this->indexMessage( ["endereco removido com sucesso", "success"] );
            }
            // Retorno de aviso, produto não encontrado
            return $this->indexMessage( ["endereco não encontrado", "warning"] );
        } catch (\Throwable $th) {
            // Retorno quando dá erro
            return $this->indexMessage( [$th->getMessage(), "danger"] );
        }
    }
}
