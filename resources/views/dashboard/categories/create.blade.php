@extends('layouts.dashboard')

@section('title', $title = 'Categories' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">$title</li>
@endsection


@section('content')

    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for=""> Category Name </label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for=""> Parent </label>
            <select type="text" name="parent_id" class="form-control form-select">
                <option >select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for=""> Description </label>
            <textarea type="text" name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for=""> Image </label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label>Status</label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" >
                      <label class="form-check-label" for="exampleRadios1">
                          Active
                      </label>
                  </div>
                   <div class="form-check">
                       <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="archived">
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
