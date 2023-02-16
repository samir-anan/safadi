@extends('layouts.dashboard')

@section('title', $title = 'Categories' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection


@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.categories.create') }}" class="btn  btn-primary">create</a>
    </div>

{{--

 @if(session()->has('success'))
        <div class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            {{ session()->get('info') }}
        </div>
    @endif
    --}}

    <x-alert type="success"/>
    <x-alert type="info"/>

    <form class="d-flex my-2 mx-6 justify-content-between " action="{{ URL::current() }}" method="get">
        <label for="email" class="mr-sm-2">Search</label>
        <x-form.input name="name" placeholder="Name" :value="request('name')" class="form-control mb-2 mx-2 mr-sm-3"></x-form.input>
        <x-form.label name="Status" ></x-form.label>
        <select type="text" name="status" class="form-control mb-2 mr-sm-2">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button type="submit" class="btn btn-primary mb-2">filter</button>
    </form>


<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
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
                <td>{{  $category->id }}</td>
                <td>

                        <img src="{{ asset('uploads/'.$category->image) }}" height="50">
                </td>
                <td>{{  $category->name }} </td>
                <td>{{  $category->parent_name ?? 'Parent Category' }} </td>
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
{{ $categories->withQueryString()->appends(['search'=>1])->links() }}
@endsection


@push('scripts')
    <script src="{{ asset('dist/js/script.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="<?php echo asset('/dist/css/style.css') ?>">
@endpush
