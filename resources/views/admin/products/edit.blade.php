@extends('adminlte::page')

@section('title', Request::is('*/edit') ? 'Edit Product' : 'View Product')

@section('content_header')
    <h1>{{ Request::is('*/edit') ? 'Edit Product' : 'View Product' }}</h1>
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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Details</h3>
                    </div>
                    <div class="card-body row">

                        <!-- Collection -->
                        <div class="form-group col-md-4">
                            <label for="collection_id">Collection</label>
                            <select id="collection_id" name="collection" class="form-control" required
                                @if (!Request::is('*/edit')) disabled @endif>
                                <option value="">Select Collection</option>
                                @foreach ($collections as $collection)
                                    <option value="{{ $collection->id }}"
                                        {{ $collection->id == old('collection_id', $product->collection) ? 'selected' : '' }}>
                                        {{ $collection->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Category -->
                        <div class="form-group col-md-4">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_name" class="form-control" required
                                @if (!Request::is('*/edit')) disabled @endif>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id', $product->category_name) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Range -->
                        <div class="form-group col-md-4">
                            <label for="range_id">Range</label>
                            <select id="range_id" name="ranges" class="form-control" required
                                @if (!Request::is('*/edit')) disabled @endif>
                                <option value="">Select Range</option>
                                @foreach ($ranges as $range)
                                    <option value="{{ $range->id }}"
                                        {{ $range->id == old('range_id', $product->ranges) ? 'selected' : '' }}>
                                        {{ $range->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Code -->
                        <div class="form-group col-md-4">
                            <label for="product_code">Product Code</label>
                            <input type="text" value="{{ old('product_code', $product->product_code) }}"
                                name="product_code" class="form-control" required
                                @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Thumbnail Picture -->
                        @if (Request::is('*/edit'))
                            <div class="form-group col-md-6">
                                <label for="thumbnail_picture">Thumbnail Picture</label>
                                <input type="file" name="thumbnail_picture" class="form-control"
                                    accept="image/png, image/gif, image/jpeg">
                                @if ($product->thumbnail_picture)
                                    <h5>Existing Thumbnail Picture:</h5>
                                    <img src="{{ asset('storage/' . $product->thumbnail_picture) }}" width="100"
                                        class="mt-2">
                                @endif
                            </div>
                        @else
                            @if ($product->thumbnail_picture)
                                <div class="form-group col-md-6">
                                    <label>Thumbnail Picture</label><br>
                                    <img src="{{ asset('storage/' . $product->thumbnail_picture) }}" width="100"
                                        class="mt-2">
                                </div>
                            @endif
                        @endif

                        <!-- Product Title -->
                        <div class="form-group col-md-4">
                            <label for="product_title">Product Title</label>
                            <input type="text" name="product_title"
                                value="{{ old('product_title', $product->product_title) }}" class="form-control" required
                                @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Series -->
                        <div class="form-group col-md-4">
                            <label for="series">Series</label>
                            <input type="text" name="Series" value="{{ old('series', $product->Series) }}"
                                class="form-control" @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Shape -->
                        <div class="form-group col-md-4">
                            <label for="shape">Shape</label>
                            <input type="text" name="shape" value="{{ old('shape', $product->shape) }}"
                                class="form-control" @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Spray -->
                        <div class="form-group col-md-4">
                            <label for="spray">Spray</label>
                            <input type="text" name="spray" value="{{ old('spray', $product->spray) }}"
                                class="form-control" @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Product Description -->
                        <div class="form-group col-md-12">
                            <label for="product_description">Product Description</label>
                            @if (Request::is('*/edit'))
                                <textarea name="product_description" id="product_description" class="form-control" rows="3">{{ old('product_description', $product->product_description) }}</textarea>
                            @else
                                <p style="white-space: pre-wrap;">{!! $product->product_description !!}</p>
                            @endif
                        </div>

                        <!-- Size -->
                        <div class="form-group col-md-4">
                            <label for="size">Size</label>
                            <input type="text" name="size" value="{{ old('size', $product->size) }}"
                                class="form-control" @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Price -->
                        <div class="form-group col-md-4">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="{{ old('price', $product->price) }}"
                                class="form-control" @if (!Request::is('*/edit')) disabled @endif>
                        </div>

                        <!-- Main Product Image -->
                        @if (Request::is('*/edit'))
                            <div class="form-group col-md-6">
                                <label for="product_image">Main Product Image</label>
                                <input type="file" name="product_image" class="form-control"
                                    accept="image/png, image/gif, image/jpeg">
                                @if ($product->product_image)
                                    <h5>Existing Product Image:</h5>
                                    <img src="{{ asset('storage/' . $product->product_image) }}" width="100"
                                        class="mt-2">
                                @endif
                            </div>
                        @else
                            @if ($product->product_image)
                                <div class="form-group col-md-6">
                                    <label>Main Product Image</label><br>
                                    <img src="{{ asset('storage/' . $product->product_image) }}" width="100"
                                        class="mt-2">
                                </div>
                            @endif
                        @endif

                        <!-- Diagram Image -->
                        @if (Request::is('*/edit'))
                            <div class="form-group col-md-6">
                                <label for="diagram_image_name">Diagram Image</label>
                                <input type="file" name="diagram_image_name" class="form-control"
                                    accept="image/png, image/gif, image/jpeg">
                                @if ($product->diagram_image_name)
                                    <h5>Existing Diagram Image:</h5>
                                    <img src="{{ asset('storage/' . $product->diagram_image_name) }}" width="100"
                                        class="mt-2">
                                @endif
                            </div>
                        @else
                            @if ($product->diagram_image_name)
                                <div class="form-group col-md-6">
                                    <label>Diagram Image</label><br>
                                    <img src="{{ asset('storage/' . $product->diagram_image_name) }}" width="100"
                                        class="mt-2">
                                </div>
                            @endif
                        @endif

                        <!-- Additional Images -->
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $imageField = 'additional_image' . $i;
                                $imagePath = $product->$imageField ?? null;
                            @endphp

                            <div class="form-group col-md-4">
                                <label for="additional_image{{ $i }}">Additional Image
                                    {{ $i }}</label>
                                @if (Request::is('*/edit'))
                                    <input type="file" name="additional_image{{ $i }}"
                                        class="form-control" accept="image/png, image/gif, image/jpeg">
                                @endif
                                @if ($imagePath)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $imagePath) }}" width="100"
                                            alt="Additional Image {{ $i }}">
                                    </div>
                                @endif
                            </div>
                        @endfor

                        <!-- Installation and Service Parts -->
                        <div class="form-group col-md-4">
                            <label for="installation_service_parts">Installation and Service Parts</label>
                            <input type="text" name="installation_service_parts"
                                class="form-control @error('installation_service_parts') is-invalid @enderror"  @if (!Request::is('*/edit')) disabled @endif
                                value="{{ old('installation_service_parts', $product->installation_service_parts ?? '') }}">
                            @error('installation_service_parts')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Feature Image -->
                        <div class="form-group col-md-4">
                            <label for="feature_image">Features Image</label>
                            <input type="file" name="feature_image"
                                class="form-control-file @error('feature_image') is-invalid @enderror"
                                accept="image/png, image/gif, image/jpeg"  @if (!Request::is('*/edit')) disabled @endif>
                            @error('feature_image')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                            @if (!empty($product->feature_image))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $product->feature_image) }}" width="100"
                                        alt="Feature Image" >
                                </div>
                            @endif
                        </div>

                        <!-- Additional Info -->
                        <div class="form-group col-md-2">
                            <label for="additional_information">Additional Information</label>
                            <input type="text" name="additional_information"
                                class="form-control @error('additional_information') is-invalid @enderror"
                                value="{{ old('additional_information', $product->additional_information ?? '') }}"  @if (!Request::is('*/edit')) disabled @endif>
                            @error('additional_information')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Submit button only in edit mode -->
                        @if (Request::is('*/edit'))
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success">Update Product</button>
                            </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        // Initialize CKEditor 5 for the categories_text textarea
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
    </script>
@endsection
