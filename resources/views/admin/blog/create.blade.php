@extends('adminlte::page')

@section('title', 'Create Blog Post')

@section('content_header')
    <h1>Create Blog Post</h1>
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
    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{-- Banner Image --}}
            <div class="form-group col-md-6">
                <label for="banner_image">Banner Image</label>
                <input type="file" name="banner_image" class="form-control" accept="image/*" required>
            </div>

            {{-- Short Description --}}
            <div class="form-group col-md-6">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description') }}</textarea>
            </div>

            {{-- Gallery Images --}}
            <div class="form-group col-md-12 mt-3">
                <label for="gallery">Gallery Images</label>
                <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
            </div>

            {{-- Long Description --}}
            <div class="form-group col-md-12 mt-3">
                <label for="long_description">Long Description</label>
                <textarea name="long_description" id="long_description" class="form-control">{{ old('long_description') }}</textarea>
            </div>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Save Blog Post</button>
        </div>
    </form>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#short_description'))
            .catch(error => console.error(error));

        ClassicEditor
            .create(document.querySelector('#long_description'))
            .catch(error => console.error(error));
    </script>
@stop
