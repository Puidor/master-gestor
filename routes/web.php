<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\PedidoController;
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
//Rota Login recebe o parametro erro opcicional '?'
Route::get('/login{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

//Rotas dentro de /app que chamam middleware log.acesso e autenticação nessa ordem de execução
Route::middleware('log.acesso', 'autenticacao:ldap,visitante')->prefix('/app')->group(function() {  
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');

    //Método antiquado de definir rotas
    //Rotas de Fornecedor
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    //Melhor método para definir rotas

    //Rotas de Produto
    Route::resource('produto', ProdutoController::class);
    //Rotas de ProdutoDetalhe
    Route::resource('produto-detalhe', ProdutoDetalheController::class);

    //Rotas de Cliente, Pedido e PedidoProduto
    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    // Route::resource('pedido-produto', PedidoProdutoController::class);

    Route::get('pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    // Route::delete('pedido-produto/destroy/{pedido}/{produto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
    Route::delete('pedido-produto/destroy/{pedidoProduto}/{pedido_id}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Clique Aqui</a> para ir para página inicial';
});
