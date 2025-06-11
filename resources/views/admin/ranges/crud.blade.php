@extends('adminlte::page')

@section('title', 'Ranges Management')

@section('content_header')
    <h1>Ranges Management</h1>
@stop

@section('content')
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-{{ isset($editRange) ? 'edit' : 'plus' }}"></i>
                        {{ isset($editRange) ? 'Edit' : 'Add' }} Range
                    </h3>
                </div>

                {{-- Form --}}
                <form action="{{ isset($editRange) ? route('admin.ranges.update', $editRange->id) : route('admin.ranges.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($editRange)) @method('PUT') @endif

                    <div class="card-body">
                        {{-- Collection --}}
                        <div class="form-group">
                            <label>Collection *</label>
                            <select name="collection_id"
                                    id="{{ isset($editRange) ? 'collection_id_edit' : 'collection_id' }}"
                                    class="form-control @error('collection_id') is-invalid @enderror"
                                    required>
                                <option value="">Select Collection</option>
                                @foreach ($collections as $collection)
                                    <option value="{{ $collection->id }}"
                                        {{ old('collection_id', isset($editRange) ? $editRange->category->collection_id : '') == $collection->id ? 'selected' : '' }}>
                                        {{ $collection->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('collection_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Category --}}
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="category_id"
                                    id="{{ isset($editRange) ? 'category_id_edit' : 'category_id' }}"
                                    class="form-control @error('category_id') is-invalid @enderror"
                                    required>
                                <option value="">Select Category</option>
                                @foreach ($categoriesForCollection as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', isset($editRange) ? $editRange->category_id : '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $editRange->name ?? '') }}" required>
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Description *</label>
                            <input type="text" name="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                   value="{{ old('description', $editRange->description ?? '') }}" required>
                            @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Thumbnail --}}
                        <div class="form-group">
                            <label>Thumbnail Image</label>
                            <input type="file" name="thumbnail_image"
                                   class="form-control-file @error('thumbnail_image') is-invalid @enderror"
                                   accept="image/*">
                            @if (isset($editRange->thumbnail_image))
                                <img src="{{ asset('storage/' . $editRange->thumbnail_image) }}" width="100" class="mt-2">
                            @endif
                            @error('thumbnail_image') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Order --}}
                        <div class="form-group">
                            <label>Order</label>
                            <input type="number" name="order"
                                   class="form-control @error('order') is-invalid @enderror"
                                   value="{{ old('order', $editRange->order ?? 0) }}">
                            @error('order') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Active --}}
                        <div class="form-group">
                            <input type="hidden" name="is_active" value="0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox"
                                       class="custom-control-input"
                                       id="{{ isset($editRange) ? 'is_active_edit' : 'is_active_create' }}"
                                       name="is_active" value="1"
                                    {{ old('is_active', $editRange->is_active ?? false) ? 'checked' : '' }}>
                                <label class="custom-control-label"
                                       for="{{ isset($editRange) ? 'is_active_edit' : 'is_active_create' }}">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-{{ isset($editRange) ? 'primary' : 'success' }}">
                            <i class="fas fa-save"></i> {{ isset($editRange) ? 'Update' : 'Create' }}
                        </button>
                        @if (isset($editRange))
                            <a href="{{ route('admin.ranges.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times-circle"></i> Cancel
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Right Section - Table --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list"></i> Ranges List</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Collection</th>
                                <th>Category</th>
                                <th>Range Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ranges as $range)
                                <tr>
                                    <td>{{ $range->category->collection->name ?? '-' }}</td>
                                    <td>{{ $range->category->name ?? '-' }}</td>
                                    <td>{{ $range->name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $range->is_active ? 'success' : 'danger' }}">
                                            {{ $range->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.ranges.index', ['edit' => $range->id]) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No ranges found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#collection_id, #collection_id_edit').on('change', function() {
            var collectionId = $(this).val();
            let categorySelect = $(this).attr('id') === 'collection_id' ? '#category_id' : '#category_id_edit';

            $(categorySelect).empty().append('<option value="">Select Category</option>');

            if (collectionId) {
                $.ajax({
                    url: '{{ route('admin.ranges.getCategoriesByCollection') }}',
                    method: 'GET',
                    data: { collection_id: collectionId },
                    success: function(response) {
                        response.forEach(function(category) {
                            $(categorySelect).append(
                                $('<option>', {
                                    value: category.id,
                                    text: category.name
                                })
                            );
                        });
                    }
                });
            }
        });
    });
</script>
@endpush
