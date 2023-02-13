@extends('layouts.dashboard')

@section('title', $title = 'Edit Category' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection


@section('content')

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for=""> Category Name </label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for=""> Parent </label>
            <select type="text" name="parent_id" class="form-control form-select">
                <option >select Category</option>
                @foreach($categories as $parent)
                    <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected': '' }}>{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for=""> Description </label>
            <textarea type="text" name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label for=""> Image </label>
            <input type="file" name="image" class="form-control">
            @if($category->image)
                <img src="{{ asset('uploads/'.$category->image) }}" height="50">
            @endif
        </div>
        <div class="form-group">
            <label>Status</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" value="active" @checked($category->status == 'active') >
                      <label class="form-check-label" for="exampleRadios1">
                          Active
                      </label>
                  </div>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="status" @checked($category->status == 'archived') value="archived">
                       <label class="form-check-label" for="exampleRadios2">
                           Archived
                       </label>
                   </div>
           </div>
        </div>
        <div>
           <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection



@push('scripts')
    <script src="{{ asset('dist/js/script.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="<?php echo asset('/dist/css/style.css') ?>">
@endpush
