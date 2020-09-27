@extends('admin.template')

@section('title') {{ __('message.advertising_management') }} @endsection
@section('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dropdown_menu')

@endsection

@section('content')
    <form action="{{ route('admin.advertising.update', $advertising->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group row">
            <label class="col-md-2" for="banner_top" >{{ __('message.top_banner') }}</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="banner_top" id="banner_top" value="{{ $advertising->banner_top }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input"
                           @if ( $advertising->enable_banner_top ) checked @endif
                           name="enable_banner_top" id="enable_banner_top">
                    <label class="custom-control-label" for="enable_banner_top">Enable top banner</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input"
                           @if ( $advertising->show_homepage_banner_top ) checked @endif
                           name="show_homepage_banner_top" id="show_homepage_banner_top">
                    <label class="custom-control-label" for="show_homepage_banner_top">Enable top banner in frontpage</label>
                </div>
            </div>
        </div>

        <hr style="border-top: 1px solid #2962ff;" />

        <div class="form-group row">
            <label class="col-md-2" for="" >{{ __('message.top_banner_content') }}</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="content_top" id="content_top" value="{{ $advertising->content_top }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input"
                           @if ( $advertising->enable_content_top ) checked @endif
                           name="enable_content_top" id="enable_content_top">
                    <label class="custom-control-label" for="enable_content_top">Enable top banner in content</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input"
                           @if ( $advertising->show_homepage_content_top ) checked @endif
                           name="show_homepage_content_top" id="show_homepage_content_top">
                    <label class="custom-control-label" for="show_homepage_content_top">Enable top banner in content in frontpage</label>
                </div>
            </div>
        </div>

        <hr style="border-top: 1px solid #2962ff;" />

        <div class="form-group row">
            <label class="col-md-2" for="" >{{ __('message.left_banner') }}</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="banner_left" id="banner_left" value="{{ $advertising->banner_left }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2" for="" >{{ __('message.right_banner') }}</label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="banner_right" id="banner_right" value="{{ $advertising->banner_right }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input"
                           @if ( $advertising->enable_banner_banner_left_and_right ) checked @endif
                           name="enable_banner_banner_left_and_right" id="enable_banner_banner_left_and_right">
                    <label class="custom-control-label" for="enable_banner_banner_left_and_right">Enable left and right banner</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input"
                           @if ( $advertising->show_homepage_banner_left_and_right ) checked @endif
                           name="show_homepage_banner_left_and_right" id="show_homepage_banner_left_and_right">
                    <label class="custom-control-label" for="show_homepage_banner_left_and_right">Enable left and right banner in frontpage</label>
                </div>
            </div>
        </div>

        <hr style="border-top: 1px solid #2962ff;" />

        <div class="card">
            <div class="card-body">

                <div class="input-group">
                    <button type="submit" class="btn btn-primary">{{ __('message.Save') }}</button>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('footer-scripts')
    @if (\Session::has('success'))
        <script>
            toastr.success('{!! \Session::get('success') !!}');
        </script>

    @endif
@endsection
