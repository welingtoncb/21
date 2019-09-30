@extends('adminlte::page')

@section('title', 'Vinteum')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bem vindo {{ Auth::user()->name }}!</p>
    <br />
    <p><b>Total de imóveis cadastrados: </b>{{ $totalImoveisCadastrados }}</p>
@stop