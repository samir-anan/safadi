@extends('layouts.dashboard')

@section('title', $title = 'Products' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection


@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.products.create') }}" class="btn  btn-primary mr-2">create</a>
        <a href="{{ route('dashboard.products.trashed') }}" class="btn  btn-dark">Trash</a>
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
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>created at</th>
            <th colspan="2" >Actions</th>
        </tr>
    </thead>
    <tbody>
    @if($products->count())
        @foreach($products as $product)
            <tr>
                <td>{{  $product->id }}</td>
                <td>
                        <img src="{{ asset('uploads/'.$product->image) }}" height="50">
                </td>
                <td>{{  $product->name }} </td>
                <td>{{  $product->category_id }} </td>
                <td>{{  $product->store_id }} </td>
                <td>{{  $product->status }} </td>
                <td>{{  $product->created_at }} </td>
                <td>
                    <a href="{{ route('dashboard.products.edit',['product' => $product->id] ) }}" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{ route('dashboard.products.destroy',$product->id) }}">
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
          <td colspan="9"> No Products Found </td>
        </tr>
    @endif
    </tbody>

</table>
{{ $products->withQueryString()->appends(['search'=>1])->links() }}
@endsection


@push('scripts')
    <script src="{{ asset('dist/js/script.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="<?php echo asset('/dist/css/style.css') ?>">
@endpush
