@extends('adminlte::page')

@section('title', 'Vinteum')

@section('content_header')
    <h1>Listagem</h1>
@stop

@section('js')
    <script src="js/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>
@stop

@section('css')
    <link href="js/lightbox/dist/css/lightbox.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
@stop

@section('content')

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>Ação</th>
            <th>Código</th>
            <th>Título</th>
            <th>Tipo</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>UF</th>
            <th>CEP</th>
            <th>Valor Venda</th>
            <th>Valor Locação</th>
            <th>Valor Temporada</th>
            <th>Metros Quadrados</th>
            <th>Dormitórios</th>
            <th>Suítes</th>
            <th>Salas</th>
            <th>Garagens</th>
            <th>Imagem</th>
            <th>Descrição</th>
        </tr>
        @foreach($imoveis as $imovel)
        <tr>
            <td>
                <a href="{{url("imovel/{$imovel->id}/edit")}}">Editar</a>
                <p></p>
                <a href="{{url("delete/{$imovel->id}")}}">Deletar</a>
            </td>
            <td>{{$imovel->codigo}}</td>
            <td>{{$imovel->titulo}}</td>
            <td>{{$imovel->tipo}}</td>
            <td>{{$imovel->endereco}}</td>
            <td>{{$imovel->numero}}</td>
            <td>{{$imovel->complemento}}</td>
            <td>{{$imovel->bairro}}</td>
            <td>{{$imovel->cidade}}</td>
            <td>{{$imovel->uf}}</td>
            <td>{{$imovel->cep}}</td>
            <td>{{number_format($imovel->valor_venda,2,',','.')}}</td>
            <td>{{number_format($imovel->valor_locacao,2,',','.')}}</td>
            <td>{{number_format($imovel->valor_temporada,2,',','.')}}</td>
            <td>{{$imovel->metro_quadrado}}</td>
            <td>{{$imovel->quantidade_dormitorio}}</td>
            <td>{{$imovel->quantidade_suite}}</td>
            <td>{{$imovel->quantidade_sala}}</td>
            <td>{{$imovel->quantidade_garagem}}</td>
            <td>
                @if($imovel->imagem != "")
                    <a href="{{ Storage::url("imoveis/{$imovel->imagem}") }}" data-lightbox="roadtrip">Clique aqui para exibir a imagem</a>
                @endif
            </td>
            <td>{{$imovel->descricao}}</td>
        </tr>
        @endforeach
    </table>
    
</div>
    
@stop