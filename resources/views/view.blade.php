@extends('adminlte::page')

@section('title', 'Vinteum')

@section('content_header')
    <h1>Detalhes do imóvel</h1>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
@stop

@section('css')
    <link href="../js/lightbox/dist/css/lightbox.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')

<div class="box table-responsive">
    <p>
        <b>Código: </b>{{$imovel->codigo}}
    </p>
    <p>
        <b>Título: </b>{{$imovel->titulo}}
    </p>
    <p>
        <b>Tipo: </b>{{$imovel->tipo}}
    </p>
    <p>
        <b>Endereço: </b>{{$imovel->endereco}}
    </p>
    <p>
        <b>Número: </b>{{$imovel->numero}}
    </p>
    <p>
        <b>Complemento: </b>{{$imovel->complemento}}
    </p>
    <p>
        <b>Bairro: </b>{{$imovel->bairro}}
    </p>
    <p>
        <b>Cidade: </b>{{$imovel->cidade}}
    </p>
    <p>
        <b>UF: </b>{{$imovel->uf}}
    </p>
    <p>
        <b>CEP: </b>{{$imovel->cep}}
    </p>
    <p>
        <b>Valor venda: </b>{{number_format($imovel->valor_venda,2,',','.')}}
    </p>
    <p>
        <b>Valor locação: </b>{{number_format($imovel->valor_locacao,2,',','.')}}
    </p>
    <p>
        <b>Valor temporada: </b>{{number_format($imovel->valor_temporada,2,',','.')}}
    </p>
    <p>
        <b>Metros quadrados: </b>{{$imovel->metro_quadrado}}
    </p>
    <p>
        <b>Dormitórios: </b>{{$imovel->quantidade_dormitorio}}
    </p>
    <p>
        <b>Suítes: </b>{{$imovel->quantidade_suite}}
    </p>
    <p>
        <b>Salas: </b>{{$imovel->quantidade_sala}}
    </p>
    <p>
        <b>Garagens: </b>{{$imovel->quantidade_garagem}}
    </p>
    <p>
        <b>Descrição: </b>{{$imovel->descricao}}
    </p>

    @if($imovel->storage)
        <a href="{{ url("storage/imoveis/{$imovel->imagem}") }}" data-lightbox="roadtrip">Ampliar</a>
    @else
        <b>Imagem: </b><a href="{{ $imovel->imagem }}" data-lightbox="roadtrip">Clique para exibir</a>
    @endif

</div>
    
@stop