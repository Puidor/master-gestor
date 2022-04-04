@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Adicionar Produto</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="" method="post"> @csrf
                    {{-- Input Nome --}}
                    <input type="text" name="nome" value="" placeholder="Nome" class="borda-preta">

                    {{-- Input Descrição --}}
                    <input type="text" name="descricao" value="" placeholder="Descrição" class="borda-preta">
 
                    {{-- Input Peso --}}
                    <input type="text" name="peso" value="" placeholder="Peso" class="borda-preta">

                    {{-- Select unidade_id --}}
                    <select name="unidade_id">
                        <option>Selecione a unidade de medida</option>
                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}">{{ $unidade->descricao }}</option>
                        @endforeach
                    </select>

                    {{-- BOTão Cadastrar --}}
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection