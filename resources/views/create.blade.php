@extends('adminlte::page')

@section('title', 'Vinteum')

@section('js')
    <script type="text/javascript" src="{{ asset('js/lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
@stop

@section('css')
    <link href="{{ asset('js/lightbox/dist/css/lightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
@stop

@section('content_header')
    <h1>Gestão de Imóveis</h1>
@stop

<div class="container">
    <div class="row">
        @section('content')

            @if (session('status'))
                <div id="alerta_sucesso" class="alert alert-success">
                    {{ session('status') }}
                </div>
                {{--  <p class="alert {{ Session::get('status') }}">{{ Session::get('status') }}</p>  --}}
            @endif

            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

            @if(isset($imovel))
                {!! Form::model($imovel, ['route' => ['update', $imovel->id], 'enctype' => 'multipart/form-data', 'method' => 'PUT', 'name'=>'form1', 'class' => 'form']) !!}
            @else
                {!! Form::open(['route' => ['store', 'criacao'], 'name' => 'form1', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
            @endif
                
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('codigo', 'Código') }}
                    {{ Form::text('codigo', null, ['class'=>'form-control','maxlength'=>'20','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('titulo', 'Título') }}
                    {{ Form::text('titulo', null, ['class'=>'form-control','maxlength'=>'200','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('tipo', 'Tipo') }}
                    {{ Form::select('tipo', $tipos, isset($tipoSelecionado) ? $tipoSelecionado : null, ['class'=>'form-control', 'placeholder'=>'Selecione....', 'required'=>true]) }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('cep', 'CEP') }}
                    {{ Form::text('cep', null, ['id'=>'cep','class'=>'form-control','maxlength'=>'8','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('endereco', 'Endereço') }}
                    {{ Form::text('endereco', null, ['id'=>'endereco','class'=>'form-control','maxlength'=>'200','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-4">    
                <div class="form-group">
                    {{ Form::label('numero', 'Número') }}
                    {{ Form::text('numero', null, ['id'=>'numero','class'=>'form-control','maxlength'=>'10','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('complemento', 'Complemento') }}
                    {{ Form::text('complemento', null, ['class'=>'form-control','maxlength'=>'50']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('bairro', 'Bairro') }}
                    {{ Form::text('bairro', null, ['id'=>'bairro','class'=>'form-control','maxlength'=>'100','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('cidade', 'Cidade') }}
                    {{ Form::text('cidade', null, ['id'=>'cidade','class'=>'form-control','maxlength'=>'100','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('uf', 'UF') }}
                    {{ Form::text('uf', null, ['id'=>'uf','class'=>'form-control','maxlength'=>'2','required'=>true]) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('valor_venda', 'Valor Venda') }}
                    {{ Form::text('valor_venda', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('valor_locacao', 'Valor Locação') }}
                    {{ Form::text('valor_locacao', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('valor_temporada', 'Valor Temporada') }}
                    {{ Form::text('valor_temporada', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('metro_quadrado', 'Metros Quadrados') }}
                    {{ Form::text('metro_quadrado', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('quantidade_dormitorio', 'Dormitórios') }}
                    {{ Form::text('quantidade_dormitorio', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('quantidade_suite', 'Suítes') }}
                    {{ Form::text('quantidade_suite', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('quantidade_sala', 'Salas') }}
                    {{ Form::text('quantidade_sala', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('quantidade_garagem', 'Garagens') }}
                    {{ Form::text('quantidade_garagem', null, ['class'=>'form-control']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('imagem', 'Imagem') }}
                    @if( isset($imovel) && $imovel->storage)
                        &nbsp;&nbsp;<a href="{{ url("storage/imoveis/{$imovel->imagem}") }}" data-lightbox="roadtrip">Exibir imagem cadastrada</a>
                    @elseif( isset($imovel) && !$imovel->storage)
                        &nbsp;&nbsp;<a href="{{ $imovel->imagem }}" data-lightbox="roadtrip">Exibir imagem cadastrada</a>
                    @endif
                        {!! Form::file('imagem', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('descricao', 'Descrição') }}
                    {!! Form::textarea('descricao', null, ['class'=>'form-control', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    @if(isset($imovel))
                        <button name="btnControle" class="btn btn-primary">Alterar</button>
                    @else
                        <button name="btnControle" class="btn btn-primary">Cadastrar</button>
                    @endif
                </div>
            </div>
                {!! Form::close() !!}
            @stop
    </div>
</div>