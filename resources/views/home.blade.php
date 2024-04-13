@extends('layouts.app')

@section('titulo')
    Pagina principal nueva
@endsection

@section('contenido')
   
<x-listar-post :posts="$posts"/>
@endsection
