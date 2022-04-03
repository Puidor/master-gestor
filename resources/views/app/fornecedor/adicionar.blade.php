@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - Adicionar</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>
        <div class="informacao-pagina">
            {{ $msg ?? '' }}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action="{{ route('app.fornecedor.adicionar') }}" method="post"> @csrf
                    <input type="hidden" name="id" value="{{ $fornecedor->id ?? '' }}">
                    {{-- Input Nome --}}
                    <input type="text" name="nome" value="{{$fornecedor->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
                    {{-- Verifica se valor passado no input nome passou na validação. Se não passou a variavel errors irá retornar um erro  que será mostrado em tela --}}
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    {{-- Input Site --}}
                    <input type="text" name="site" value="{{ $fornecedor->site ?? old('site') }}" placeholder="Site" class="borda-preta">
                    {{ $errors->has('site') ? $errors->first('site') : '' }}

                    {{-- Input UF --}}
                    <input type="text" name="uf" value="{{ $fornecedor->uf ?? old('uf') }}" placeholder="UF" class="borda-preta">
                    {{ $errors->has('uf') ? $errors->first('uf') : '' }}

                    {{-- Input EMAIL --}}
                    <input type="text" name="email" value="{{ $fornecedor->email ?? old('email') }}" placeholder="Email" class="borda-preta">
                    {{ $errors->has('email') ? $errors->first('email') : '' }}
                    {{-- BOTão Cadastrar --}}
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection