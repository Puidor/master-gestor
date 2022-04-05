<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Trás o modelo Fornecedor para o controller
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(Request $request){
        // Cria uma variável para armazenar o resultado da consulta ao banco de dados através do modelo Fornecedor
        //Pesquisa no banco de dados os registros que contenham o termo informado pelo usuário em cada input
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome'))
        ->where('site', 'like', '%'.$request->input('site'))
        ->where('uf', 'like', '%'.$request->input('uf'))
        ->where('email', 'like', '%'.$request->input('email'))
        ->simplePaginate(5); //Mostra 2 registros por pagina
        
        // Retorna a view app.fornecedor.listar com a variável $fornecedores e os parametros passados pelo formulario na variavel request
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){

        $msg = '';

        //Verifica se existe um token de requisição sendo transmitido e se o ID está vazio irá ADICIONAR um novo registro
        if($request->input('_token') != '' && $request->input('id') == ''){
            //Validação
            $regras = [
                'nome' => 'required|min:3|max:100',
                'site' => 'required|min:3|max:100',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
            //Mensagens de erro
            $feedback = [
                'required' => 'O campo :attribute é obrigatório.',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
                'nome.max' => 'O campo nome deve ter no máximo 100 caracteres.',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caracteres.',
                'uf.max' => 'O campo UF deve ter no máximo 2 caracteres.',
                'email.email' => 'O campo email deve ser um e-mail válido.'
            ];
            //Cria o objeto de validação
            $request->validate($regras, $feedback);

            //Cria um novo objeto do modelo Fornecedor
            $fornecedor = new Fornecedor();
            //Preenche os atributos do objeto com os valores do formulário
            $fornecedor->create($request->all());

            //Enviar dados para a view
            $msg = 'Fornecedor cadastrado com sucesso!';
        }

        //Verifica se existe um token de requisição sendo transmitido e se o ID estiver um valor iremos EDITAR um registro
        if($request->input('_token') != '' && $request->input('id') != ''){
            //Busca o registro no banco de dados pelo ID
            $fornecedor = Fornecedor::find($request->input('id'));
            //Update dos registro com os dados do formulário
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Fornecedor atualizado com sucesso!';
            } else {
                $msg = 'Erro ao atualizar o fornecedor!';
            }
            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg'=> $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id){
        $fornecedor = Fornecedor::find($id);
        $fornecedor->delete();

        return redirect()->route('app.fornecedor');
    }
}
