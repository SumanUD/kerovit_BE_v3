@extends('adminlte::page')

@section('title', 'Edit Blog Post')

@section('content_header')
    <h1>Edit Blog Post</h1>
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
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{-- Banner Image --}}
            <div class="form-group col-md-6">
                <label for="banner_image">Banner Image</label>
                <input type="file" name="banner_image" class="form-control" accept="image/*">
                @if($blog->banner_image)
                    <img src="{{ asset('storage/' . $blog->banner_image) }}" class="img-fluid mt-2" style="max-height: 200px;">
                @endif
            </div>

            {{-- Short Description --}}
            <div class="form-group col-md-6">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', $blog->short_description) }}</textarea>
            </div>

            {{-- Gallery Images --}}
            <div class="form-group col-md-12 mt-3">
                <label for="gallery">Gallery Images (Upload More)</label>
                <input type="file" name="gallery[]" class="form-control" multiple accept="image/*">
                @if($blog->gallery)
                    <div class="row mt-2">
                        @foreach(json_decode($blog->gallery) as $image)
                            <div class="col-md-3 mb-2">
                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid" style="max-height: 150px;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Long Description --}}
            <div class="form-group col-md-12 mt-3">
                <label for="long_description">Long Description</label>
                <textarea name="long_description" id="long_description" class="form-control">{{ old('long_description', $blog->long_description) }}</textarea>
            </div>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Update Blog Post</button>
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
