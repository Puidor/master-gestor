<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(){
        return view('app.fornecedor.listar');
    }

    public function adicionar(Request $request){
        //Verifica se existe um token de requisição sendo transmitido
        if($request->input('_token') != ''){
            //Validação
            $regras = [
                'nome' => 'required|min:3|max:100',
                'site' => 'required|min:3|max:100',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];
        }

        return view('app.fornecedor.adicionar');
    }
}
