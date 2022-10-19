<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function showMessage($message)
    {
        try{
            $userInfo = DB::select('SELECT * FROM USER_INFOS');
        } catch (\Throwable $th){
            return view("UserInfo/show")->with("tipoProdutos", [])->with("message", [$th->getMessage(), "danger"]);
        }

        return view("UserInfo/show")->with("tipoProdutos", $userInfo)->with("message", $message);
    }
    public function create()
    {
        return view("UserInfo/create");
    }

    public function store(Request $request)
    {
        // try{


            $userInfo = new UserInfo();
            $userInfo-> Users_id = 1;
            $userInfo-> status = 'A';
            $userInfo-> profileImg = $request-> profileImg;
            $userInfo-> dataNasc = $request->dataNasc;
            $userInfo-> genero = $request->genero;
            $userInfo-> save();
            return redirect()->route("userinfo.show",1)->with("userInfo",$userInfo);

        // }catch(\Throwable $th){
        //     return $this->showMessage([$th->getMessage(), "danger"]);
        // }

        // return $this->showMessage(["UserInfo cadastrado com sucesso", "sucesso"]);
    }

    public function show($id)
    {
        $userInfo = UserInfo::where('Users_id',$id)-> first();
        if(isset($userInfo)){
            return view("UserInfo/show")->with("userInfo", $userInfo);
        }
        return view("UserInfo/create");



        // try{
        //     $userInfo = DB::select('SELECT * FROM USER_INFOS');
        //     if(count($userInfo)>0){
        //         return view("UserInfo/show")->with("userInfo",$userInfo[0]);
        //     }
        //     else{
        //         return $this->indexMessage(["UserInfo não foi encontrado", "warning"]);
        //     }
        // }catch(\Throwablw $th){
        //     return $this->indexMessage([$th->getMessage(),"danger"]);
        // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // try{
            $userInfo = UserInfo::find($id); //retorna obj ou null
            //Se o obj é valido ou null
            if(isset($userInfo)){
                return view("UserInfo/edit")->with("userInfo",$userInfo);
            }else{
                return $this->showMessage(["UserInfo não encontrado", "warning"]);
            }
        // }catch(\Throwable $th){
        //     return $this->showMessage([$th->getMessage(), "danger"]);
        // }
    }

    public function update(Request $request, $id)
    {
        // try{
            $userInfo = UserInfo::find($id);

            if(isset($userInfo)){
                $userInfo-> profileImg = $request-> profileImg;
                $userInfo-> dataNasc = $request->dataNasc;
                $userInfo-> genero = $request->genero;
                $userInfo->update();
                //Recarregar a view index
                return $this->showMessage(["UserInfo atualizado com sucesso", "success"]);
            }else{
                return $this->showMessage(["UserInfo não encontrado", "warning"]);
            }

        // }catch(\Throwable $th){
        //     return $this->showMessage([$th->getMessage(), "danger"]);
        // }
    }


    public function destroy($id)
    {
        // try{
            $userInfo = UserInfo :: find($id); //Retirna o objeto, caso contrario retorna null
            //se existir
            if(isset($userInfo)){
                $userInfo -> delete();
                return view("UserInfo/create");

            }
             //Retorno do aviso, caso nao encontre o produto
             return $this-> showMessage(["TipoProduto não foi encontrado", "warning"]);
        // }catch(\Throwable $th){
        //     return $this-> indexMessage([$th -> getMessage(), "danger"]);
        // }
    }
}
