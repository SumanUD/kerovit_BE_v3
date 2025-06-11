@extends('adminlte::page')

@section('title', 'Create/Edit Home Page')

@section('content_header')
    <h1>Edit Home Page</h1>
@stop

<style>
    .cke_notifications_area {
        display: none;
    }
</style>

@section('content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>There were some errors with your input:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-body">
            <form action="{{ isset($homePage) ? route('homepage.update', $homePage->id) : route('homepage.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($homePage))
                    @method('PUT')
                @endif

                <!-- Banner Type Selection -->
                <div class="form-group">
                    <label for="banner_type">Banner Type</label>
                    <select name="banner_type" id="banner_type" class="form-control" required>
                        <option value="video"
                            {{ old('banner_type', $homePage->banner_type ?? '') == 'video' ? 'selected' : '' }}>Video
                        </option>
                        <option value="slider"
                            {{ old('banner_type', $homePage->banner_type ?? '') == 'slider' ? 'selected' : '' }}>Slider
                        </option>
                    </select>
                    @error('banner_type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Video URL -->
                <div class="form-group" id="video_url_group" style="display: none;">
                    <label for="video_url">Video URL</label>
                    <input type="url" name="video_url" id="video_url" class="form-control"
                        value="{{ old('video_url', $homePage->video_url ?? '') }}" >
                    @error('video_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Slider Images -->
                <div class="form-group" id="slider_images_group" style="display: none;">
                    <label for="slider_images">Slider Images</label>
                    <input type="file" name="slider_images[]" id="slider_images" class="form-control" multiple 
                        accept="image/png, image/gif, image/jpeg">
                    @error('slider_images')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @error('slider_images.*')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if (isset($homePage) && $homePage->slider_images)
                        <div class="mt-2">
                            <h5>Existing Slider Images:</h5>
                            <div class="row">
                                @foreach (json_decode($homePage->slider_images) as $image)
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail"
                                            style="max-width: 100%; height: 100px;" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div id="image_preview" class="row mt-3"></div>
                </div>

                <!-- Categories Text -->
                <div class="form-group">
                    <label for="categories_text">Categories Text</label>
                    <textarea name="categories_text" id="categories_text" class="form-control">{{ old('categories_text', $homePage->categories_text ?? '') }}</textarea>
                    @error('categories_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>




                <!-- Aurum Text -->
                <div class="form-group">
                    <label for="aurum_text">Aurum Text</label>
                    <textarea name="aurum_text" id="aurum_text" class="form-control">{{ old('aurum_text', $homePage->aurum_text ?? '') }}</textarea>
                    @error('aurum_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Klassic Text -->
                <div class="form-group">
                    <label for="klassic_text">Klassic Text</label>
                    <textarea name="klassic_text" id="klassic_text" class="form-control">{{ old('klassic_text', $homePage->klassic_text ?? '') }}</textarea>
                    @error('klassic_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- World Of Kerovit Text -->
                <div class="form-group">
                    <label for="world_of_kerovit_text">World Of Kerovit Text</label>
                    <textarea name="world_of_kerovit_text" id="world_of_kerovit_text" class="form-control">{{ old('world_of_kerovit_text', $homePage->world_of_kerovit_text ?? '') }}</textarea>
                    @error('world_of_kerovit_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- World Of Kerovit Image -->
                <div class="form-group">
                    <label for="world_of_kerovit_image">World Of Kerovit Image</label>
                    <input type="file" name="world_of_kerovit_image" id="world_of_kerovit_image" class="form-control"
                        value="{{ old('world_of_kerovit_image', $homePage->world_of_kerovit_image ?? '') }}"  accept="image/png, image/gif, image/jpeg">
                    @error('world_of_kerovit_image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if (isset($homePage) && $homePage->world_of_kerovit_image)
                        <div class="mt-2">
                            <h5>Existing World Of Kerovit Image:</h5>
                            <img src="{{ asset('storage/' . $homePage->world_of_kerovit_image) }}" class="img-thumbnail"
                                style="max-width: 100%; height: 300px;">
                        </div>
                    @endif
                </div>

                <!-- World Of Kerovit Button Text -->
                <div class="form-group">
                    <label for="world_of_kerovit_button_text">World Of Kerovit Button Text</label>
                    <input type="text" name="world_of_kerovit_button_text" id="world_of_kerovit_button_text"
                        class="form-control"
                        value="{{ old('world_of_kerovit_button_text', $homePage->world_of_kerovit_button_text ?? '') }}">
                    @error('world_of_kerovit_button_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- World Of Kerovit Button URL -->
                <div class="form-group">
                    <label for="world_of_kerovit_button_url">World Of Kerovit Button URL</label>
                    <input type="url" name="world_of_kerovit_button_url" id="world_of_kerovit_button_url"
                        class="form-control"
                        value="{{ old('world_of_kerovit_button_url', $homePage->world_of_kerovit_button_url ?? '') }}">
                    @error('world_of_kerovit_button_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="catalogue_pdf_1">Catalogue PDF 1</label>
                    <input type="file" name="catalogue_pdf_1" id="catalogue_pdf_1" class="form-control" accept="application/pdf">
                    @error('catalogue_pdf_1')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if (isset($homePage) && $homePage->catalogue_pdf_1)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $homePage->catalogue_pdf_1) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                View Existing PDF 1
                            </a>
                            <br><br>
                            <embed src="{{ asset('storage/' . $homePage->catalogue_pdf_1) }}" type="application/pdf"
                                width="200px" height="200px" />
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="catalogue_pdf_2">Catalogue PDF 2</label>
                    <input type="file" name="catalogue_pdf_2" id="catalogue_pdf_2" class="form-control" accept="application/pdf">
                    @error('catalogue_pdf_2')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if (isset($homePage) && $homePage->catalogue_pdf_2)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $homePage->catalogue_pdf_2) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                View Existing PDF 2
                            </a>
                            <br><br>
                            <embed src="{{ asset('storage/' . $homePage->catalogue_pdf_2) }}" type="application/pdf"
                                width="200px" height="200px" />
                        </div>
                    @endif
                </div>


                <!-- About Us Text -->
                <div class="form-group">
                    <label for="about_us_text">About Us Text</label>
                    <textarea name="about_us_text" id="about_us_text" class="form-control">{{ old('about_us_text', $homePage->about_us_text ?? '') }}</textarea>
                    @error('about_us_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- About Us Image -->
                <div class="form-group">
                    <label for="about_us_image">About Us Image</label>
                    <input type="file" name="about_us_image" id="about_us_image" class="form-control">
                    @error('about_us_image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if (isset($homePage) && $homePage->about_us_image)
                        <div class="mt-2">
                            <h5>Existing About Us Image:</h5>
                            <img src="{{ asset('storage/' . $homePage->about_us_image) }}" class="img-thumbnail"
                                style="max-width: 100%; height: 300px;">
                        </div>
                    @endif
                </div>

                <!-- About Us Button Text -->
                <div class="form-group">
                    <label for="about_us_button_text">About Us Button Text</label>
                    <input type="text" name="about_us_button_text" id="about_us_button_text" class="form-control"
                        value="{{ old('about_us_button_text', $homePage->about_us_button_text ?? '') }}">
                    @error('about_us_button_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- About Us Button URL -->
                <div class="form-group">
                    <label for="about_us_button_url">About Us Button URL</label>
                    <input type="url" name="about_us_button_url" id="about_us_button_url" class="form-control"
                        value="{{ old('about_us_button_url', $homePage->about_us_button_url ?? '') }}">
                    @error('about_us_button_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load Latest CKEditor 4.25.1-lts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    <script>
        // Initialize CKEditor 5 for the categories_text textarea
        ClassicEditor
            .create(document.querySelector('#categories_text'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor for categories_text:', error);
            });

        // Initialize CKEditor 5 for the world_of_kerovit_text textarea
        ClassicEditor
            .create(document.querySelector('#world_of_kerovit_text'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor for world_of_kerovit_text:', error);
            });

        // Initialize CKEditor 5 for the aurum_text textarea
        ClassicEditor
            .create(document.querySelector('#aurum_text'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor for aurum_text:', error);
            });

        // Initialize CKEditor 5 for the klassic_text textarea
        ClassicEditor
            .create(document.querySelector('#klassic_text'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor for klassic_text:', error);
            });
    </script>

    <script>
        $(document).ready(function() {
            toggleBannerFields($('#banner_type').val());

            $('#banner_type').change(function() {
                toggleBannerFields($(this).val());
            });

            $('#slider_images').on('change', function(event) {
                $('#image_preview').empty();
                const files = event.target.files;
                if (files && files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const img = $('<img>').attr('src', e.target.result).addClass(
                                'img-thumbnail').css('max-width', '100%').css('height', 'auto').css(
                                'margin-right', '10px');
                            const col = $('<div>').addClass('col-md-4').append(img);
                            $('#image_preview').append(col);
                        };

                        reader.onerror = function() {
                            alert('Error reading file!');
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });

            function toggleBannerFields(bannerType) {
                if (bannerType === 'video') {
                    $('#video_url_group').show();
                    $('#slider_images_group').hide();
                } else {
                    $('#video_url_group').hide();
                    $('#slider_images_group').show();
                }
            }
        });
    </script>
@stop
