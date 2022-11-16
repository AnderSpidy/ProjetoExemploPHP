<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web'); // Especificando qual guarda estamos utilizando
    }
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
        // Pega o id do usuário logado
        $loggedUserId = Auth::user()->id;

        try{
            $userInfo = new UserInfo();
            $userInfo->Users_id = $loggedUserId;
            $userInfo->status = 'A';
            $userInfo->profileImg = $request->profileImg;
            $userInfo->dataNasc = $request->dataNasc;
            $userInfo->genero = $request->genero;
            $userInfo->save();
        } catch (\Throwable $th) {
            return view("UserInfo/create")->with("message", [$th->getMessage(), "danger"]);
        }
        $userInfo = UserInfo::where('Users_id', $loggedUserId)->first();
        return view("UserInfo/show")->with("userInfo", $userInfo)->with("message", ["Informação cadastrada com sucesso", "success"]);
    }

    public function show($id)
    {
        try {
            $userInfo = UserInfo::where('Users_id', $id)->where('Users_id', Auth::user()->id)->first();
            //$userInfo = UserInfo::find($id);
            if(isset($userInfo)){
                // Returno do sucesso
                return view("UserInfo/show")->with("userInfo", $userInfo);
            }
            // Returno do aviso
            return view("home");
        } catch (\Throwable $th) {
            // Returno do erro
            return view("UserInfo/create")->with("message", [$th->getMessage(), "danger"]);
        }

    }

    public function edit($id)
    {
        try {
            $userInfo = UserInfo::where('Users_id', $id)->where('Users_id', Auth::user()->id)->first();
            //$userInfo = UserInfo::find($id);
            if(isset($userInfo)){
                return view("UserInfo/edit")->with("userInfo", $userInfo);
            }
            // Returno do aviso
            return view("home");
        } catch (\Throwable $th) {
            // Returno do erro
            return view("UserInfo/create")->with("message", [$th->getMessage(), "danger"]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Pega o id do usuário logado
            $loggedUserId = Auth::user()->id;

            $userInfo = UserInfo::where('Users_id', $id)->first();
            if(isset($userInfo)){
                $userInfo->Users_id = $loggedUserId;
                $userInfo->status = 'A';
                $userInfo->profileImg = $request->profileImg;
                $userInfo->dataNasc = $request->dataNasc;
                $userInfo->genero = $request->genero;
                $userInfo->update();
            }
            $userInfo = UserInfo::where('Users_id', $loggedUserId)->first();
            return view("UserInfo/show")->with("userInfo", $userInfo)->with("message", ["Informação atualizada com sucesso", "success"]);
        } catch (\Throwable $th) {
            // Returno do erro
            return view("UserInfo/create")->with("message", [$th->getMessage(), "danger"]);
        }
    }


    public function destroy($id)
    {
        try {
            $userInfo = UserInfo::where('Users_id', $id)->where('Users_id', Auth::user()->id)->first();
            //$userInfo = UserInfo::find($id);
            if(isset($userInfo)){
                $userInfo->delete();
                return view("UserInfo/create")->with("message", ["Informação removida com sucesso", "success"]);
            }
            // Returno do aviso
            return view("home");
        } catch (\Throwable $th) {
            // Returno do erro
            return view("UserInfo/create")->with("message", [$th->getMessage(), "danger"]);
        }
    }
}
