<?php

use Illuminate\Support\Facades\Route;
use App\Models\TipoProduto;
use App\Models\Produto;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('tipoproduto', "App\Http\Controllers\TipoProdutoController@index")->name("tipoproduto.index");
Route::get('tipoproduto/create', "App\Http\Controllers\TipoProdutoController@create")->name("tipoproduto.create");
Route::post('tipoproduto', "App\Http\Controllers\TipoProdutoController@store")->name("tipoproduto.store");
Route::get('tipoproduto/{id}', "App\Http\Controllers\TipoProdutoController@show")->name("tipoproduto.show");
Route::get('tipoproduto/{id}/edit', "App\Http\Controllers\TipoProdutoController@edit")->name("tipoproduto.edit");
Route::put('tipoproduto/{id}/edit', "App\Http\Controllers\TipoProdutoController@update")->name("tipoproduto.update");

Route::get('produto', "App\Http\Controllers\ProdutoController@index")->name("produto.index");
Route::get('produto/create', "App\Http\Controllers\ProdutoController@create")->name("produto.create");
Route::post('produto', "App\Http\Controllers\ProdutoController@store")->name("produto.store");
Route::get('produto/{id}', "App\Http\Controllers\ProdutoController@show")->name("produto.show");
Route::get('produto/{id}/edit', "App\Http\Controllers\ProdutoController@edit")->name("produto.edit");
Route::put('produto/{id}/edit', "App\Http\Controllers\ProdutoController@update")->name("produto.update");
//Esta rota, ela faz automaticamente no padrão que o laravel espera, sem precisar Rota por Rota
//Route:: resource('produto',"App\Http\Controllers\ProdutoController");

Route::get('teste', function () {
    $produto = Db::select('SELECT * FROM PRODUTOS where id = 1')[0]; //retorna um array [] ou [obj...]
   //$produto = Produto::find(1); //retorna null ou obj
   // $produto = Produto::where('preco',8) -> first();
   //$produto = Produto::where('preco',8) -> get();
   // $produto->nome ='Pepperoni';
   // $produto->update();
   dd($produto);
});



//tarefa 4
Route::get("tipoproduto/add/{descricao}", function($descricao){
    $tipoProduto = new TipoProduto();
    $tipoProduto->descricao = $descricao;
    $tipoProduto->save();
});

Route::get("produto/add/{nome}/{preco}/{Tipo_Produtos_id}/{ingredientes}/{urlImage}",
function($nome, $preco, $Tipo_Produtos_id, $ingredientes, $urlImage){
    $produto = new Produto();
    $produto->nome = $nome;
    $produto->preco = $preco;
    $produto->Tipo_Produtos_id = $Tipo_Produtos_id;
    $produto->ingredientes = $ingredientes;
    $produto->urlImage = $urlImage;
    $produto->save();
});
