{{ $slot }} {{-- {{ $slot }} -> Recebe conteudo injetado dentro do componente --}}

{{-- {{ $classe }} -> Borda Preta ou Borda Branca --}}

<form action={{ route('site.contato') }} method="post">
    @csrf
    {{-- CAMPO NOME --}}
    <input name="nome" value="{{old('nome')}}" type="text" placeholder="Nome" class="{{ $classe }}">
    {{-- Tratamento de erro --}}
    @if($errors->has('nome'))
        <p>{{ $errors->first('nome') }}</p>
    @endif
    <br>

    {{-- CAMPO TELEFONE --}}
    <input name="telefone" value="{{old('telefone')}}" type="text" placeholder="Telefone" class="{{ $classe }}">
    {{-- Tratamento de erro --}}
    {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}
    <br>

    {{-- CAMPO EMAIL --}}
    <input name="email" value="{{old('email')}}" type="text" placeholder="E-mail" class="{{ $classe }}">
    {{-- Tratamento de erro --}}
    {{ $errors->has('email') ? $errors->first('email') : '' }}
    <br>

    {{-- CAMPO MOTIVO CONTATO --}}
    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach($motivo_contatos as $key => $motivo_contato)
            <option value="{{$motivo_contato->id}}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : ''}}>{{ $motivo_contato->motivo_contato }}</option>
        @endforeach
    </select>
    {{-- Tratamento de erro --}}
    {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : '' }}
    <br>

    {{-- CAMPO MENSAGEM --}}
    <textarea name="mensagem" class="{{ $classe }}">@if (old('mensagem') != '') {{ old('mensagem') }} @else Preencha aqui a sua mensagem @endif</textarea>
    {{-- Tratamento de erro --}}
    {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}
    <br>

    {{-- BOTÃO ENVIAR --}}
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
</form>

{{-- Verifica se retorna erro e mostra o erro em tela --}}
@if($errors->any())
    <div style="position:absolute; top:0px; width:100%; background:red">
        @foreach ($errors->all() as $error)
            {{ $error }} <br>     
        @endforeach
    </div>
@endif