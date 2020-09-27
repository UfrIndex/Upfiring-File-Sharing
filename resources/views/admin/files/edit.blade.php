@extends('admin.template')

@section('title') Edit UFR file @endsection

@section('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dropdown_menu')

@endsection

@section('content')
    <form action="{{ route('admin.files.update', $file->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        @include('admin.files.partials.form')
    </form>

@endsection

@section('footer-scripts')

@endsection