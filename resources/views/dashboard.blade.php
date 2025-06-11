@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">
    <!-- Total Collection -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body text-center">
                <h5 class="card-title">Total Collection</h5>
                <p class="card-text">{{ $totalCollections }}</p>
                <a href="{{ url('/admin/collections') }}" class="btn btn-light">Go</a>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <h5 class="card-title">Categories</h5>
                <p class="card-text">{{ $totalCategories }}</p>
                <a href="{{ url('/admin/categories') }}" class="btn btn-light">Go</a>
            </div>
        </div>
    </div>

    <!-- Dealers -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h5 class="card-title">Dealer</h5>
                <p class="card-text">{{ $totalDealers }}</p>
                <a href="{{ url('/admin/dealers') }}" class="btn btn-light">Go</a>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="col-md-3 mb-4">
        <div class="card text-white bg-danger">
            <div class="card-body text-center">
                <h5 class="card-title">Products</h5>
                <p class="card-text">{{ $totalProducts }}</p>
                <a href="{{ url('/products/getdata') }}" class="btn btn-light">Go</a>
            </div>
        </div>
    </div>
</div>

@stop
