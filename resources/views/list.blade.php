@extends('adminlte::page')

@section('title', 'Vinteum')

@section('content_header')
    <h1>Listagem</h1>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/lightbox/dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lightbox-disable-options.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
@stop

@section('css')
    <link href="js/lightbox/dist/css/lightbox.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
@stop

@section('content')

<div id="confirm-destroy" class="modal fade bottom" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn-danger">
                <h4 class="modal-title"><i class="fa fa-trash-o"></i>Exclusão</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-success" id="delete"><i class="fa fa-check"></i>Sim</button>
                <button type="button" data-dismiss="modal" class="btn btn-default"><i class="fa fa-times"></i>Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bottom modal-waiting-system" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-clock-o"></i>Aguarde....</h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" style="width:100%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<div class="box table-responsive">
    <div class="box-header">
        {!! Form::open(['route' => ['searchImmobile'], 'name' => 'form1', 'class' => 'form']) !!}
            {{ Form::text('codigo', null, ['class'=>'form-control','placeholder'=>'Código do imóvel:']) }}
            {{ Form::button('Pesquisar', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>Ação</th>
            <th>Código</th>
            <th>Título</th>
            <th>Tipo</th>
            <th>Valor Venda</th>
            <th>Valor Locação</th>
            <th>Valor Temporada</th>
            <th>Metros Quadrados</th>
            <th>Dormitórios</th>
            <th>Suítes</th>
            <th>Salas</th>
            <th>Garagens</th>
            <th>Imagem</th>
        </tr>
        @foreach($imoveis as $imovel)
        <tr>
            <td>
                <a href="{{url("view/{$imovel->id}")}}" class="btn btn-default" title="Visualizar" data-original-title="Visualizar"><i class="fa fa-eye text-green"></i></a>
                <a href="{{url("imovel/{$imovel->id}/edit")}}" class="btn btn-primary" title="Editar" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
                <a message="Deseja realmente excluir?" route="{{url("delete/{$imovel->id}")}}" href="javascript:void(0)" class="btn btn-danger btn_destroy_in_table" title="Excluir"><i class="fa fa-trash-o"></i></a>
            </td>
            <td>{{$imovel->codigo}}</td>
            <td>{{$imovel->titulo}}</td>
            <td>{{$imovel->tipo}}</td>
            <td>{{number_format($imovel->valor_venda,2,',','.')}}</td>
            <td>{{number_format($imovel->valor_locacao,2,',','.')}}</td>
            <td>{{number_format($imovel->valor_temporada,2,',','.')}}</td>
            <td>{{$imovel->metro_quadrado}}</td>
            <td>{{$imovel->quantidade_dormitorio}}</td>
            <td>{{$imovel->quantidade_suite}}</td>
            <td>{{$imovel->quantidade_sala}}</td>
            <td>{{$imovel->quantidade_garagem}}</td>
            <td>
                @php
                    if( file_exists('storage/imoveis/'.$imovel->imagem )) {
                        echo '<a href="storage/imoveis/'.$imovel->imagem.'" data-lightbox="roadtrip">Exibir</a>';
                    } else {
                        echo '<a href="'.$imovel->imagem.'" data-lightbox="roadtrip">Exibir</a>';
                    }
                @endphp
                {{--  @if( file_exists("storage/imoveis/{$imovel->imagem}" ))
                    <a href="{{ url("storage/imoveis/{$imovel->imagem}") }}" data-lightbox="roadtrip">Exibir</a>
                @else
                    <a href="{{ $imovel->imagem) }}" data-lightbox="roadtrip">Exibir</a>
                @endif  --}}
            </td>
        </tr>
        @endforeach
    </table>
    
    @if(isset($dataForm))
        {{$imoveis->appends($dataForm)->links()}}
    @else
        {{$imoveis->links()}}
    @endif
</div>
    
@stop