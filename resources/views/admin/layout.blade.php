@extends('adminlte::page')

@section('title', 'Admin Panel')

@section('content_header')
    <h1>@yield('page_title')</h1>
@stop

@section('content')
    @yield('admin_content')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Admin panel loaded!'); </script>
@stop