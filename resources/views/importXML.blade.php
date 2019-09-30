@extends('adminlte::page')

@section('title', 'Vinteum')

@section('content_header')
    <h1>Importar imóveis</h1>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lightbox-disable-options.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
@stop

@section('css')
    <link href="../js/lightbox/dist/css/lightbox.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" />
@stop

@section('content')

<div class="box table-responsive">
    @if (session('status'))
        <div id="alerta_sucesso" class="alert alert-success">
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

    @if (isset($errorsCustom) && count($errorsCustom) > 0)
        <div class="alert alert-danger">
            @foreach($errorsCustom as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif


    {!! Form::open(['route' => ['import'], 'name' => 'form', 'enctype' => 'multipart/form-data', 'class' => 'form']) !!}
        {{ Form::label('arquivo', 'Arquivo') }}
        {!! Form::file('arquivo', ['class' => 'form-control', 'style' => 'padding: 6px 0px !important;']) !!}
        {{ Form::button('Enviar', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
    <hr></hr>
    
    @if(count($imoveisViews) > 0)
        <h5><b>Imóveis disponíveis</b></h5>

        @foreach($imoveisViews as $imovel)
            {!! Form::open(['route' => ['store','importacao'], 'name' => 'form1', 'class' => 'form']) !!}
                <p>
                    <b>Código: </b>{{ $imovel['codigo'] }}
                        {!! Form::hidden('codigo', $imovel['codigo']) !!}
                    <br />
                    <b>Título: </b>{{ $imovel['titulo'] }}
                        {!! Form::hidden('titulo', $imovel['titulo']) !!}
                    <br />
                    <b>Tipo: </b>{{ $imovel['tipo'] }}
                        {!! Form::hidden('tipo', $imovel['tipo']) !!}
                    <br />
                    <b>Cidade: </b>{{ $imovel['cidade'] }}
                        {!! Form::hidden('cidade', $imovel['cidade']) !!}
                    <br />
                    <b>UF: </b>{{ $imovel['uf'] }}
                        {!! Form::hidden('uf', $imovel['uf']) !!}
                    <br />
                    <b>Número: </b>{{ $imovel['numero'] }}
                        {!! Form::hidden('numero', $imovel['numero']) !!}
                    <br />
                    <b>Complemento: </b>{{ $imovel['complemento'] }}
                        {!! Form::hidden('complemento', $imovel['complemento']) !!}
                    <br />
                    <b>Bairro: </b>{{ $imovel['bairro'] }}
                        {!! Form::hidden('bairro', $imovel['bairro']) !!}
                    <br />
                    <b>CEP: </b>{{ $imovel['cep'] }}
                        {!! Form::hidden('cep', str_replace('.', '', str_replace('-', '', $imovel['cep']))) !!}
                    <br />
                    <b>Valor Venda: </b>R$ {{ number_format(floatval($imovel['valor_venda']),2,',','.') }}
                        {!! Form::hidden('valor_venda', $imovel['valor_venda']) !!}
                    <br />
                    <b>Valor Locação: </b>R$ {{ number_format(floatval($imovel['valor_locacao']),2,',','.') }}
                        {!! Form::hidden('valor_locacao', $imovel['valor_locacao']) !!}
                    <br />
                    <b>Valor Temporada: </b>R$ {{ number_format(floatval($imovel['valor_temporada']),2,',','.') }}
                        {!! Form::hidden('valor_temporada', $imovel['valor_temporada']) !!}
                    <br />
                    <b>Metros Quadrados: </b>{{ $imovel['metro_quadrado'] }}
                        {!! Form::hidden('metro_quadrado', $imovel['metro_quadrado']) !!}
                    <br />
                    <b>Dormitórios: </b>{{ $imovel['quantidade_dormitorio'] }}
                        {!! Form::hidden('quantidade_dormitorio', $imovel['quantidade_dormitorio']) !!}
                    <br />
                    <b>Suítes: </b>{{ $imovel['quantidade_suite'] }}
                        {!! Form::hidden('quantidade_suite', $imovel['quantidade_suite']) !!}
                    <br />
                    <b>Salas: </b>{{ $imovel['quantidade_sala'] }}
                        {!! Form::hidden('quantidade_sala', $imovel['quantidade_sala']) !!}
                    <br />
                    <b>Garagens: </b>{{ $imovel['quantidade_garagem'] }}
                        {!! Form::hidden('quantidade_garagem', $imovel['quantidade_garagem']) !!}
                    <br />
                    <b>Imagem: </b>
                        @if($imovel['imagem'] != "")
                            <a href="{{ $imovel['imagem'] }}" data-lightbox="roadtrip">Clique para exibir</a>
                        @endif
                        {!! Form::hidden('imagem', $imovel['imagem']) !!}
                    <br />
                    <b>Descrição: </b>
                    <br />
                    {{ $imovel['descricao'] }}
                        {!! Form::hidden('descricao', $imovel['descricao']) !!}
                    <br /><br />
                    {{ Form::button('Importar', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                    <hr></hr>
                </p>
            {!! Form::close() !!}
        @endforeach
        
        {{ $imoveisViews->links() }}
    @else
        <h5><b>Nenhum imóvel disponível para importação</b></h5>
    @endif
</div>

@stop