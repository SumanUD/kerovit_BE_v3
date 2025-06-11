@extends('adminlte::page')

@section('title', 'Career Page CMS')

@section('content_header')
    <h1>Career Page CMS</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($career) ? route('career.update', $career->id) : route('career.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if (isset($career))
            @method('PUT')
        @endif

        <div class="row">

            {{-- Banner Image --}}
            <div class="form-group col-md-6">
                <label for="banner_image">Banner Image</label>
                <input type="file" name="banner_image" class="form-control" accept="image/png, image/gif, image/jpeg">
                @if (isset($career->banner_image))
                    <img src="{{ asset('storage/' . $career->banner_image) }}" class="img-fluid mt-2"
                        style="max-height: 200px;">
                @endif
                @error('banner_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Banner Text --}}
            <div class="form-group col-md-6">
                <label for="banner_text">Banner Text</label>
                <input type="text" name="banner_text" class="form-control"
                    value="{{ old('banner_text', $career->banner_text ?? '') }}">
                @error('banner_text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Below Banner Description --}}
            <div class="form-group col-md-12">
                <label for="below_banner_description">Below Banner Description</label>
                <textarea name="below_banner_description" id="below_banner_description" class="form-control" rows="5">{{ old('below_banner_description', $career->below_banner_description ?? '') }}</textarea>
                @error('below_banner_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Center Image --}}
            <div class="form-group col-md-6">
                <label for="center_image">Center Image</label>
                <input type="file" name="center_image" class="form-control" accept="image/png, image/gif, image/jpeg">
                @if (isset($career->center_image))
                    <img src="{{ asset('storage/' . $career->center_image) }}" class="img-fluid mt-2"
                        style="max-height: 200px;">
                @endif
                @error('center_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Application Email --}}
            <div class="form-group col-md-6">
                <label for="application_email">Application Email</label>
                <input type="email" name="application_email" class="form-control"
                    value="{{ old('application_email', $career->application_email ?? '') }}">
                @error('application_email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">{{ isset($career) ? 'Update' : 'Save' }}</button>
        </div>
    </form>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#below_banner_description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@stop

@stop
