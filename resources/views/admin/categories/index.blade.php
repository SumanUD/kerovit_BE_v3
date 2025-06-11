@extends('adminlte::page')

@section('title', 'Categories Management')

@section('content_header')
    <h1>Categories Management</h1>
@stop

@section('content')
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



    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($category) ? 'Edit' : 'Add' }} Category</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Please correct the errors below.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- CREATE FORM (visible when $category is not set) --}}
                @if (!isset($category))
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <h5>Create New Category</h5>

                            <div class="form-group">
                                <label>Collection *</label>
                                <select name="collection_id" class="form-control" required>
                                    @foreach ($collections as $collection)
                                        <option value="{{ $collection->id }}"
                                            {{ old('collection_id') == $collection->id ? 'selected' : '' }}>
                                            {{ $collection->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('collection_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description *</label>
                                <input type="text" name="description" class="form-control" value="{{ old('description') }}"required>
                               @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror 
                            </div>

                            <div class="form-group">
                                <label>Thumbnail Image</label>
                                <input type="file" name="thumbnail_image" class="form-control-file"
                                    accept="image/png, image/gif, image/jpeg">
                                @error('thumbnail_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Order</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="is_active" value="0">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active_store"
                                        name="is_active" value="1" {{ old('is_active', false) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active_store">Active</label>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                @endif

                {{-- UPDATE FORM (visible when $category is set) --}}
                @if (isset($category))
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <h5>Edit Category</h5>

                            <div class="form-group">
                                <label>Collection *</label>
                                <select name="collection_id" class="form-control" required>
                                    @foreach ($collections as $collection)
                                        <option value="{{ $collection->id }}"
                                            {{ old('collection_id', $category->collection_id) == $collection->id ? 'selected' : '' }}>
                                            {{ $collection->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $category->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description *</label>
                                <input type="text" name="description" class="form-control" value="{{ old('description', $category->description) }}"
                                    required>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Thumbnail Image</label>
                                <input type="file" name="thumbnail_image" class="form-control-file"
                                    accept="image/png, image/gif, image/jpeg">
                                @if ($category->thumbnail_image)
                                <h5>Existing Thumbnail Image</h5>
                                    <img src="{{ asset('storage/' . $category->thumbnail_image) }}" width="100"
                                        class="mt-2">
                                @endif
                                @error('thumbnail_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Order</label>
                                <input type="number" name="order" class="form-control"
                                    value="{{ old('order', $category->order ?? 0) }}">
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="is_active" value="0">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active_edit"
                                        name="is_active" value="1"
                                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active_edit">Active</label>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                @endif

            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Collection Name</th>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <!-- Collection Name -->
                                    <td>{{ $category->collection->name }}</td>

                                    <!-- Category Name -->
                                    <td>{{ $category->name }}</td>

                                    <!-- Image -->
                                    <td>
                                        @if ($category->thumbnail_image)
                                            <img src="{{ asset('storage/' . $category->thumbnail_image) }}"
                                                width="50">
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        <span class="badge badge-{{ $category->is_active ? 'success' : 'danger' }}">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Form -->
                                    </td>
                                </tr>
                            @endforeach

                            @if ($categories->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No categories found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop
