@extends('adminlte::page')

@section('title', 'Add Product')

@section('content_header')
    <h1>Add Product</h1>
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

    <div class="container-fluid">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Details</h3>
                </div>
                <div class="card-body row">

                    <!-- Collection -->
                    <div class="form-group col-md-4">
                        <label for="collection_id">Collection</label>
                        <select id="collection_id" name="collection" class="form-control" required>
                            <option value="">Select Collection</option>
                            @foreach ($collections as $collection)
                                <option value="{{ $collection->id }}"
                                    {{ old('collection') == $collection->id ? 'selected' : '' }}>
                                    {{ $collection->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('collection')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="form-group col-md-4">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_name" class="form-control"
                            {{ old('collection') ? '' : 'disabled' }} required>
                            <option value="">Select Category</option>
                        </select>
                        @error('category_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Range -->
                    <div class="form-group col-md-4">
                        <label for="range_id">Range</label>
                        <select id="range_id" name="ranges" class="form-control"
                            {{ old('category_name') ? '' : 'disabled' }} required>
                            <option value="">Select Range</option>
                        </select>
                        @error('ranges')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Product Code -->
                    <div class="form-group col-md-4">
                        <label for="product_code">Product Code</label>
                        <input type="text" name="product_code" class="form-control" value="{{ old('product_code') }}" required>
                        @error('product_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Images -->
                    <div class="form-group col-md-6">
                        <label for="thumbnail_picture">Thumbnail Picture</label>
                        <input type="file" name="thumbnail_picture" class="form-control" accept="image/png, image/gif, image/jpeg">
                        @error('thumbnail_picture')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Product Title -->
                    <div class="form-group col-md-4">
                        <label for="product_title">Product Title</label>
                        <input type="text" name="product_title" class="form-control" value="{{ old('product_title') }}" required>
                        @error('product_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Series -->
                    <div class="form-group col-md-4">
                        <label for="series">Series</label>
                        <input type="text" name="Series" class="form-control" value="{{ old('Series') }}">
                        @error('Series')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Shape -->
                    <div class="form-group col-md-4">
                        <label for="shape">Shape</label>
                        <input type="text" name="shape" class="form-control" value="{{ old('shape') }}">
                        @error('shape')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Spray -->
                    <div class="form-group col-md-4">
                        <label for="spray">Spray</label>
                        <input type="text" name="spray" class="form-control" value="{{ old('spray') }}">
                        @error('spray')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group col-md-12">
                        <label for="product_description">Product Description</label>
                        <textarea name="product_description" id="product_description" class="form-control" rows="3">{{ old('product_description') }}</textarea>
                        @error('product_description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Size -->
                    <div class="form-group col-md-4">
                        <label for="size">Size</label>
                        <input type="text" name="size" class="form-control" value="{{ old('size') }}">
                        @error('size')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group col-md-4">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Main Product Image -->
                    <div class="form-group col-md-6">
                        <label for="product_image">Main Product Image</label>
                        <input type="file" name="product_image" class="form-control" accept="image/png, image/gif, image/jpeg">
                        @error('product_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Diagram Image -->
                    <div class="form-group col-md-6">
                        <label for="diagram_image_name">Diagram Image</label>
                        <input type="file" name="diagram_image_name" class="form-control" accept="image/png, image/gif, image/jpeg">
                        @error('diagram_image_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    @for ($i = 1; $i <= 5; $i++)
                        <div class="form-group col-md-4">
                            <label for="additional_image{{ $i }}">Additional Image {{ $i }}</label>
                            <input type="file" name="additional_image{{ $i }}" class="form-control" accept="image/png, image/gif, image/jpeg">
                            @error("additional_image$i")
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endfor

                    <!-- Installation and Service Parts -->
                    <div class="form-group col-md-4">
                        <label for="installation_service_parts">Installation and Service Parts</label>
                        <input type="text" name="installation_service_parts" class="form-control" value="{{ old('installation_service_parts') }}">
                        @error('installation_service_parts')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Feature Image -->
                    <div class="form-group col-md-4">
                        <label for="feature_image">Features Image</label>
                        <input type="file" name="feature_image" class="form-control" accept="image/png, image/gif, image/jpeg">
                        @error('feature_image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Additional Info -->
                    <div class="form-group col-md-2">
                        <label for="additional_information">Additional Information</label>
                        <input type="text" name="additional_information" class="form-control" value="{{ old('additional_information') }}">
                        @error('additional_information')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success">Save Product</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#product_description'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor for product_description:', error);
            });
    </script>

    <script>
        $('#collection_id').on('change', function() {
            const collectionId = $(this).val();
            $('#category_id').prop('disabled', true).empty().append('<option value="">Loading...</option>');
            $('#range_id').prop('disabled', true).empty().append('<option value="">Select Range</option>');

            if (collectionId) {
                $.get('/admin/products/collections/' + collectionId + '/categories', function(data) {
                    const categorySelect = $('#category_id');
                    categorySelect.empty().append('<option value="">Select Category</option>');
                    data.categories.forEach(category => {
                        categorySelect.append(
                            `<option value="${category.id}">${category.name}</option>`);
                    });
                    categorySelect.prop('disabled', false);
                });
            }
        });

        $('#category_id').on('change', function() {
            const categoryId = $(this).val();
            $('#range_id').prop('disabled', true).empty().append('<option value="">Loading...</option>');
            if (categoryId) {
                $.get('/admin/products/categories/' + categoryId + '/ranges', function(data) {
                    const rangeSelect = $('#range_id');
                    rangeSelect.empty().append('<option value="">Select Range</option>');
                    data.ranges.forEach(range => {
                        rangeSelect.append(`<option value="${range.id}">${range.name}</option>`);
                    });
                    rangeSelect.prop('disabled', false);
                });
            }
        });

        // Load old category and range if present
        $(document).ready(function() {
            const oldCollection = "{{ old('collection') }}";
            const oldCategory = "{{ old('category_name') }}";
            const oldRange = "{{ old('ranges') }}";

            if (oldCollection) {
                $('#collection_id').val(oldCollection).trigger('change');

                $.get('/admin/products/collections/' + oldCollection + '/categories', function(data) {
                    const categorySelect = $('#category_id');
                    categorySelect.empty().append('<option value="">Select Category</option>');
                    data.categories.forEach(category => {
                        const selected = oldCategory == category.id ? 'selected' : '';
                        categorySelect.append(
                            `<option value="${category.id}" ${selected}>${category.name}</option>`
                        );
                    });
                    categorySelect.prop('disabled', false);

                    if (oldCategory) {
                        $.get('/admin/products/categories/' + oldCategory + '/ranges', function(data) {
                            const rangeSelect = $('#range_id');
                            rangeSelect.empty().append('<option value="">Select Range</option>');
                            data.ranges.forEach(range => {
                                const selected = oldRange == range.id ? 'selected' : '';
                                rangeSelect.append(
                                    `<option value="${range.id}" ${selected}>${range.name}</option>`
                                );
                            });
                            rangeSelect.prop('disabled', false);
                        });
                    }
                });
            }
        });
    </script>
@endsection
