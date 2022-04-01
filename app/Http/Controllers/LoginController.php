<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        // Cria uma variável com nome de erro
        $erro = '';
        // Verifica se a variavel de erro recebida no request = 1
        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha inválidos';
        }
        // Verifica se a variavel de erro recebida no request = 2
        if($request->get('erro') == 2){
            $erro = 'Necessário autenticar-se para acessar o sistema'; 
        }

        return view('site.login', ['erro' => $erro]);
    }

    public function autenticar(Request $request){
        //Regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //Mensagens de validação
        $feedback = [
            'usuario.email' => 'O campo usuário deve ser um e-mail válido',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        //Cria o objeto de validação com as regras e mensagens
        $request->validate($regras, $feedback);

        // Recupera os parametros do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //Iniciar o Model User
        $user = new User();
        //Faz uma comparação para verificar se o email e senha digitados estão no banco de dados e retorna uma coleção de registros com base na consulta
        $usuario = $user->where('email', $email)->where('password', $password)->get();
        $usuario = $usuario->first();

        //Verifica se o usuário existe no banco de dados verificando se o usuario possui o campo name
        if(isset($usuario->name)){
            //Cria a sessão do usuário
            session_start();
            //Atribui o nome do usuário a sessão
            $_SESSION['usuario'] = $usuario->name;
            //Atribui o email do usuário a sessão
            $_SESSION['email'] = $usuario->email;
            //Redireciona para a rota app/clientes
            return redirect()->route('app.clientes');
        } else {
            //Caso usuario não exista, redireciona para a rota login com o parametro erro = 1
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }
}
