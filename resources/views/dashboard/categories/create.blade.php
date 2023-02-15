@extends('layouts.dashboard')

@section('title', $title = 'Categories' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">$title</li>
@endsection


@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occured !</h3>
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for=""> Category Name </label>
            <input type="text" name="name"
            @class(['form-control', 'is-invalid' => $errors->has('name') ])
            {{--  @error('name') is-invalid @enderror"--}}
            >
            {{--
                @if($errors->has('name'))
                    <div class="alert alert-danger">
                        {{$errors->first('name')}}
                    </div>
                @endif
            --}}
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror

        </div>
        <div class="form-group">
            <label for=""> Parent </label>
            <select type="text" name="parent_id" class="form-control form-select">
                <option>select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for=""> Description </label>
            <textarea type="text" name="description" class="form-control"></textarea>

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for=""> Image </label>
            <input type="file" name="image" class="form-control">

            @error('image')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active">
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
