@extends('layouts.dashboard')

@section('title', $title = 'Categories' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection


@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.categories.create' ) }}" class="btn  btn-primary">create</a>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
        </div>
    @endif

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>id</th>
            <th>name</th>
            <th>parent</th>
            <th>created at</th>
            <th colspan="2" >Actions</th>
        </tr>
    </thead>
    <tbody>
    @if($categories->count())
        @foreach($categories as $category)
            <tr>
                <td></td>
                <td>{{  $category->id }} </td>
                <td>{{  $category->name }} </td>
                <td>{{  $category->parent_id }} </td>
                <td>{{  $category->created_at }} </td>
                <td>
                    <a href="{{ route('dashboard.categories.edit',['category' => $category->id] ) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{ route('dashboard.categories.destroy',$category->id) }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-sm btn-outline-danger" >Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
          <td colspan="7"> No Categories Found </td>
        </tr>
    @endif
    </tbody>

</table>

@endsection


@push('scripts')
    <script src="{{ asset('dist/js/script.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="<?php echo asset('/dist/css/style.css') ?>">
@endpush
