@extends('adminlte::page')

@section('title', 'Catalogue Page CMS')

@section('content_header')
    <h1>About Page CMS</h1>
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

    <form action="{{ isset($about) ? route('about.update', $about->id) : route('about.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if (isset($about))
            @method('PUT')
        @endif

        <div class="row">

            {{-- Banner Image --}}
            <div class="form-group col-md-6">
                <label for="banner_image">Banner Image</label>
                <input type="file" name="banner_image" class="form-control" accept="image/png, image/gif, image/jpeg">
                @if (isset($about->banner_image))
                    <h5>Existing Banner Image:</h5>
                    <img src="{{ asset('storage/' . $about->banner_image) }}" class="img-fluid mt-2"
                        style="max-height: 200px;">
                @endif
                @error('banner_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Banner Description --}}
            <div class="form-group col-md-12">
                <label for="banner_description">Banner Description</label>
                <textarea name="banner_description" id="banner_description" class="form-control" rows="4">{{ old('banner_description', $about->banner_description ?? '') }}</textarea>
                @error('banner_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Below Banner Content --}}
            <div class="form-group col-md-12">
                <label for="below_banner_content">Below Banner Content</label>
                <textarea name="below_banner_content" id="below_banner_content" class="form-control" rows="4">{{ old('below_banner_content', $about->below_banner_content ?? '') }}</textarea>
                @error('below_banner_content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Director Image --}}
            <div class="form-group col-md-6">
                <label for="director_image">Director Image</label>
                <input type="file" name="director_image" class="form-control" accept="image/png, image/gif, image/jpeg">
                @if (isset($about->director_image))
                    <h5>Existing Director Image:</h5>
                    <img src="{{ asset('storage/' . $about->director_image) }}" class="img-fluid mt-2"
                        style="max-height: 200px;">
                @endif
                @error('director_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Director Description --}}
            <div class="form-group col-md-12">
                <label for="director_description">Director Description</label>
                <textarea name="director_description" id="director_description" class="form-control" rows="4">{{ old('director_description', $about->director_description ?? '') }}</textarea>
                @error('director_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Manufacturing Items --}}
            <div class="col-md-12">
                <label>Manufacturing Items</label>
                <div id="manufacturing-section">
                    @if (old('manufacturing') || isset($about->manufacturing))
                        @foreach (old('manufacturing', $about->manufacturing ?? [['name' => '', 'description' => '']]) as $index => $item)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="file" name="manufacturing[{{ $index }}][image]"
                                        class="form-control" accept="image/png, image/gif, image/jpeg">
                                    @if (isset($item['image']))
                                        <h5>Existing Manufacturing Images:</h5>
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid mt-2"
                                            style="max-height: 100px;" accept="image/png, image/gif, image/jpeg">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="manufacturing[{{ $index }}][name]"
                                        class="form-control" placeholder="Name" value="{{ $item['name'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="manufacturing[{{ $index }}][description]"
                                        class="form-control" placeholder="Description"
                                        value="{{ $item['description'] ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                <button type="button" id="add-manufacturing" class="btn btn-sm btn-success">+ Add Manufacturing
                    Item</button>
            </div>

            {{-- Certification Images --}}
            <div class="form-group col-md-12 mt-4">
                <label for="certification_images[]">Certification Images</label>
                <input type="file" name="certification_images[]" class="form-control" multiple
                    accept="image/png, image/gif, image/jpeg">
                @if (isset($about->certification_images))
                    <div class="row mt-2">
                        <h5>Existing Certification Images:</h5>
                        @foreach ($about->certification_images as $img)
                            <div class="col-md-2">
                                <img src="{{ asset('storage/' . $img) }}" class="img-fluid" style="max-height: 100px;">
                            </div>
                        @endforeach
                    </div>
                @endif
                @error('certification_images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">{{ isset($about) ? 'Update' : 'Save' }}</button>
        </div>
    </form>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>


    <script>
        document.getElementById('add-manufacturing').addEventListener('click', function() {
            let index = document.querySelectorAll('#manufacturing-section .row').length;
            const html = `
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="file" name="manufacturing[${index}][image]" class="form-control" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="col-md-4">
                    <input type="text" name="manufacturing[${index}][name]" class="form-control" placeholder="Name">
                </div>
                <div class="col-md-4">
                    <input type="text" name="manufacturing[${index}][description]" class="form-control" placeholder="Description">
                </div>
            </div>`;
            document.getElementById('manufacturing-section').insertAdjacentHTML('beforeend', html);
        });

        // Initialize CKEditor for the textareas
        // Initialize CKEditor 5 for the banner description textarea
        ClassicEditor
            .create(document.querySelector('#banner_description'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor:', error);
            });

        // Initialize CKEditor 5 for the below banner content textarea
        ClassicEditor
            .create(document.querySelector('#below_banner_content'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor:', error);
            });

        // Initialize CKEditor 5 for the director description textarea
        ClassicEditor
            .create(document.querySelector('#director_description'))
            .catch(error => {
                console.error('There was a problem initializing CKEditor:', error);
            });
    </script>
@stop
