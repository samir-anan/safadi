@extends('layouts.dashboard')

@section('title', $title = 'Categories' )

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">$title</li>
@endsection


@section('content')



@endsection



@push('scripts')
    <script src="{{ asset('dist/js/script.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="<?php echo asset('/dist/css/style.css') ?>">
@endpush
