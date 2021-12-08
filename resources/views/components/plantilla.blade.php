@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
    {{$slot}}
@stop

@section('css')
    @stack('css')
@stop

@section('js')
    @stack('js')
@stop