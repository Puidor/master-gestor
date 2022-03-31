<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(){
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1', 
                'status' => 'N',
                'cnpj' => '00.000.000/000-00',
                'ddd' => '',
                'telefone' => '000-0000'
            ],
            1 => [
                'nome' => 'Fornecedor 2', 
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '98',
                'telefone' => '3222-2222'
            ],
            2 => [
                'nome' => 'Fornecedor 3', 
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '11',
                'telefone' => '888-88888'
            ]
        ];
        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
