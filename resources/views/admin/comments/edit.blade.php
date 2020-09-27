@extends('admin.template')

@section('title') Edit comment @endsection

@section('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dropdown_menu')

@endsection

@section('content')
    <form action="{{ route('admin.comments.update', $comment->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        @include('admin.comments.partials.form')
    </form>

@endsection

@section('footer-scripts')

@endsection