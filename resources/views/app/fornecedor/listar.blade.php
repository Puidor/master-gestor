@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>Email</th>
                            <th></th>            
                            <th></th>            
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Percorre todo o array $fornecedores --}}
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{ $fornecedor->nome}}</td>
                                <td>{{ $fornecedor->site}}</td>
                                <td>{{ $fornecedor->uf}}</td>
                                <td>{{ $fornecedor->email}}</td>
                                {{-- Linka para a rota app.fornecedor.editar e passa o atributo id do fornecedor --}}
                                <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id)}}">Excluir</a></td>
                                {{-- Linka para a rota app.fornecedor.excluir e passa o atributo id do fornecedor --}}
                                <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id)}}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $fornecedores->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection