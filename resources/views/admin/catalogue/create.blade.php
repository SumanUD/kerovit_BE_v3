@extends('adminlte::page')

@section('title', 'Catalogue Page CMS')

@section('content_header')
    <h1>Catalogue Page CMS</h1>
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
    <form action="{{ isset($catalogue) ? route('catalogue.update', $catalogue->id) : route('catalogue.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($catalogue))
            @method('PUT')
        @endif

        <div class="row">
            {{-- Banner Image --}}
            <div class="form-group col-md-6">
                <label for="banner_image">Banner Image</label>
                <input type="file" name="banner_image" class="form-control" accept="image/png, image/gif, image/jpeg" required>
                @if (isset($catalogue) && $catalogue->banner_image)
                    <img src="{{ asset('storage/' . $catalogue->banner_image) }}" alt="Banner Image" class="img-fluid mt-2"
                        style="max-height: 200px;">
                @endif
                @error('banner_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group col-md-12 mt-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $catalogue->description ?? '') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Catalogue Image 1 --}}
            <div class="form-group col-md-6 mt-3">
                <label for="catalogue_image_1">Catalogue Image 1</label>
                <input type="file" name="catalogue_image_1" class="form-control" accept="image/png, image/gif, image/jpeg" required>
                @if (isset($catalogue) && $catalogue->catalogue_image_1)
                    <img src="{{ asset('storage/' . $catalogue->catalogue_image_1) }}" alt="Catalogue Image 1"
                        class="img-fluid mt-2" style="max-height: 200px;">
                @endif
                @error('catalogue_image_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Catalogue Image 2 --}}
            <div class="form-group col-md-6 mt-3">
                <label for="catalogue_image_2">Catalogue Image 2</label>
                <input type="file" name="catalogue_image_2" class="form-control" accept="image/png, image/gif, image/jpeg" required>
                @if (isset($catalogue) && $catalogue->catalogue_image_2)
                    <img src="{{ asset('storage/' . $catalogue->catalogue_image_2) }}" alt="Catalogue Image 2"
                        class="img-fluid mt-2" style="max-height: 200px;">
                @endif
                @error('catalogue_image_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Catalogue PDF 1 --}}
            <div class="form-group col-md-6 mt-3">
                <label for="catalogue_pdf_1">Catalogue PDF 1</label>
                <input type="file" name="catalogue_pdf_1" class="form-control" accept="application/pdf" required>
                @if (isset($catalogue) && $catalogue->catalogue_pdf_1)
                    <a href="{{ asset('storage/' . $catalogue->catalogue_pdf_1) }}" target="_blank"
                        class="d-block mt-2">View PDF 1</a>
                @endif
                @error('catalogue_pdf_1')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Catalogue PDF 2 --}}
            <div class="form-group col-md-6 mt-3">
                <label for="catalogue_pdf_2">Catalogue PDF 2</label>
                <input type="file" name="catalogue_pdf_2" class="form-control" accept="application/pdf" required>
                @if (isset($catalogue) && $catalogue->catalogue_pdf_2)
                    <a href="{{ asset('storage/' . $catalogue->catalogue_pdf_2) }}" target="_blank"
                        class="d-block mt-2">View PDF 2</a>
                @endif
                @error('catalogue_pdf_2')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">{{ isset($catalogue) ? 'Update' : 'Save' }}</button>
        </div>
    </form>
@stop


@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@stop
