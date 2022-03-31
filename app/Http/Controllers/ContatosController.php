<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatosController extends Controller
{
    public function contatos(Request $request){
        //Recebe todos os registros da tabela motivo_contatos
        $motivo_contatos = MotivoContato::all();
        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){
        //Validação dos dados
        
        $regras = [
            //Define as regras de validação -> 'nome do campo' => 'regras'
            'nome' => 'required|min:3|max:40|unique:site_contatos', //Nomes com no minimo 3 caracteres e no maximo 20 e unico na tabela site_contatos
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedback = [
            //Define as mensagens de erro -> 'nome do campo' => 'mensagem de erro'
            'nome.required' => 'O campo nome é obrigatório',
            'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
            'nome.unique' => 'O nome informado já existe',
            'telefone.required' => 'O campo telefone é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'motivo_contatos_id.required' => 'O campo motivo de contato é obrigatório',
            'mensagem.required' => 'O campo mensagem é obrigatório',
            'mensagem.max' => 'O campo mensagem deve ter no maximo 2000 caracteres',

            'required' => 'O campo :attribute deve ser preenchido' //Mensagem genérica, caso a mensagem de erro não seja definida
        ];

        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
