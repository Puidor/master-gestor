<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;
// use App\Http\Middleware\LogAcessoMiddleware;

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

//Rota principal da aplicação com apelido 'site.index' e middleware 'LogAcessoMiddleware' cujo o apelido é log.acesso
Route::get('/', [PrincipalController::class, 'principal'])->name('site.index')->middleware('log.acesso');
//Rota sobre-nos com apelido 'site.sobrenos'
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
//Rota com método get contatos com apelido 'site.contato' que chama a classe contatos do ContatosController
Route::get('/contatos', [ContatosController::class, 'contatos'])->name('site.contato');
//Rota com método post contatos com apelido 'site.contato' que chama a classe salvar do ContatosController
Route::post('/contatos', [ContatosController::class, 'salvar'])->name('site.contato');
//Rota Login
Route::get('/login', function(){return 'Login';})->name('site.login');

//Rotas dentro de /app que chamam middleware log.acesso e autenticação nessa ordem de execução
Route::middleware('log.acesso', 'autenticacao:ldap,visitante')->prefix('/app')->group(function() {  
    Route::get('/clientes', function(){return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');;
    Route::get('/produtos', function(){return 'Produtos';})->name('app.produtos');;
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Clique Aqui</a> para ir para página inicial';
});
