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
        $request->validate([
            'nome' => 'required|min:3|max:40', //Nomes com no minimo 3 caracteres e no maximo 20
            'telefone' => 'required',
            'email' => 'required',
            'motivo_contato' => 'required',
            'mensagem' => 'required|max:2000'
        ]);
    }
}
