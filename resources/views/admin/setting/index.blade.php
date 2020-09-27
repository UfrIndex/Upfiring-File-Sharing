@extends('admin.template')

@section('title') Edit page @endsection

@section('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dropdown_menu')
    @include('admin.pages.partials.drop_menu')
@endsection

@section('content')
    <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label>Header scripts</label>
            <textarea class="form-control" rows="5" name="headerScript">{{ $header_script }}</textarea>
        </div>

        <div class="form-group">
            <label>Support block (footer)</label>
            <textarea class="form-control" rows="5" name="footer">{{ $footer }}</textarea>
        </div>

        <div class="form-group">
            <label>Footer scripts</label>
            <textarea class="form-control" rows="5" name="footerScript" >{{ $footer_script }}</textarea>
        </div>



        <div class="card">
            <div class="card-body">

                <div class="input-group">
                    <button type="submit" class="btn btn-primary">{{ __('message.Save') }}</button>
                </div>

    </form>

@endsection

