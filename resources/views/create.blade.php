@extends('adminlte::page')

@section('title', 'Vinteum')

@section('content_header')
    <h1>Gestão de Imóveis</h1>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
@stop

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(isset($imovel))
    <form name="form1" method="post" enctype="multipart/form-data" class="form" action="{{route('update', $imovel->id)}}">
        {!! method_field('PUT') !!}
@else
    <form name="form1" method="post" enctype="multipart/form-data" class="form" action="{{route('store')}}">
@endif

    {{ csrf_field() }}

    <div class="form-group">
        <input type="text" name="codigo" placeholder="Código:" class="form-control" value="{{$imovel->codigo or old('codigo')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="titulo" placeholder="Título:" class="form-control" value="{{$imovel->titulo or old('titulo')}}">
    </div>
    
    <div class="form-group">
        <select name="tipo" class="form-control">
            <option value="">Escolha o tipo</option>
            @foreach($tipos as $tip)
                <option value="{{$tip}}"
                        @if (isset($imovel) && $imovel->tipo == $tip || old('tipo') == $tip)
                            selected
                        @endif
                        >{{$tip}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="text" id="cep" name="cep" placeholder="CEP:" class="form-control" value="{{$imovel->cep or old('cep')}}">
    </div>

    <div class="form-group">
        <input type="text" id="endereco" name="endereco" placeholder="Endereço:" class="form-control" value="{{$imovel->endereco or old('endereco')}}">
    </div>
    
    <div class="form-group">
        <input type="text" id="numero" name="numero" placeholder="Número:" class="form-control" value="{{$imovel->numero or old('numero')}}">
    </div>

    <div class="form-group">
        <input type="text" id="complemento" name="complemento" placeholder="Complemento:" class="form-control" value="{{$imovel->complemento or old('complemento')}}">
    </div>

    <div class="form-group">
        <input type="text" id="bairro" name="bairro" placeholder="Bairro:" class="form-control" value="{{$imovel->bairro or old('bairro')}}">
    </div>
    
    <div class="form-group">
        <input type="text" id="cidade" name="cidade" placeholder="Cidade:" class="form-control" value="{{$imovel->cidade or old('cidade')}}">
    </div>

    <div class="form-group">
        <input type="text" id="uf" name="uf" placeholder="UF:" class="form-control" value="{{$imovel->uf or old('uf')}}">
    </div>

    <div class="form-group">
        <input type="text" name="valor_venda" placeholder="Valor Venda:" class="form-control" value="{{$imovel->valor_venda or old('valor_venda')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="valor_locacao" placeholder="Valor Locação:" class="form-control" value="{{$imovel->valor_locacao or old('valor_locacao')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="valor_temporada" placeholder="Valor Temporada:" class="form-control" value="{{$imovel->valor_temporada or old('valor_temporada')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="metro_quadrado" placeholder="Metros Quadrados:" class="form-control" value="{{$imovel->metro_quadrado or old('metro_quadrado')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="quantidade_dormitorio" placeholder="Quantidade Dormitórios:" class="form-control" value="{{$imovel->quantidade_dormitorio or old('quantidade_dormitorio')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="quantidade_suite" placeholder="Quantidade Suítes:" class="form-control" value="{{$imovel->quantidade_suite or old('quantidade_suite')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="quantidade_sala" placeholder="Quantidade Salas:" class="form-control" value="{{$imovel->quantidade_sala or old('quantidade_sala')}}">
    </div>
    
    <div class="form-group">
        <input type="text" name="quantidade_garagem" placeholder="Quantidade Garagens:" class="form-control" value="{{$imovel->quantidade_garagem or old('quantidade_garagem')}}">
    </div>
    
    <div class="form-group">
        @if(isset($imovel) && $imovel->imagem != "")
            
        <img src="{{ Storage::url("imoveis/{$imovel->imagem}") }}" alt="{{ $imovel->imagem }}" style="max-width: 90px;">

        @endif
        
        <input type="file" name="imagem" placeholder="Imagem:" class="form-control" value="{{$imovel->imagem or old('imagem')}}">
    </div>
    
    <div class="form-group">
        <textarea name="descricao" placeholder="Descrição" class="form-control">{{$imovel->descricao or old('descricao')}}</textarea>
    </div>
    
    <div class="form-group">
        @if(isset($imovel))
            <button name="btnControle" class="btn btn-primary">Alterar</button>
        @else
            <button name="btnControle" class="btn btn-primary">Cadastrar</button>
        @endif
    </div>
</form>
    
@stop