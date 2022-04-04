@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th></th>            
                            <th></th>            
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Percorre todo o array $produtos --}}
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome}}</td>
                                <td>{{ $produto->descricao}}</td>
                                <td>{{ $produto->peso}}</td>
                                <td>{{ $produto->unidade_id}}</td>
                                {{-- Linka para a rota app.fornecedor.editar e passa o atributo id do fornecedor --}}
                                <td><a href="">Excluir</a></td>
                                {{-- Linka para a rota app.fornecedor.excluir e passa o atributo id do fornecedor --}}
                                <td><a href="">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $produtos->appends($request)->links() }}
            </div>
        </div>
    </div>
@endsection