@extends('admin.template')

@section('title') Edit page @endsection

@section('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dropdown_menu')
    @include('admin.pages.partials.drop_menu')
@endsection

@section('content')
    <form action="{{ route('admin.pages.update', ['page' => $page ]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        @include('admin.pages.partials.form')
    </form>

@endsection

@section('footer-scripts')
    <script src="/dashboard/plugins/ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'my-editor' );
    </script>


    <script src="{{asset('dashboard/dist/speakingurl/speakingurl.min.js') }}"></script>
    <script>
        $('#title').keyup(function () {
            $('#slug').val(getSlug($('#title').val()));
        });
    </script>

@endsection
