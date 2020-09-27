@extends('admin.template')

@section('title') Website options @endsection
@section('head-scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dropdown_menu')

@endsection

@section('content')
    <form action="{{ route('admin.option.update', $option->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="false"><span class="hidden-xs-down">General setting</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false"><span class="hidden-xs-down">Homepage</span></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active show" id="home" role="tabpanel">
                    <div class="p-20">
                        <div class="form-group row">
                            <label class="col-md-2" for="" >{{ __('message.title') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="title" id="title" value="{{ $option->title }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="" >{{ __('message.description') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="description" id="description" value="{{ $option->description }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="" >{{ __('message.templates') }}</label>
                            <div class="col-md-12">
                                <select class="select2 form-control custom-select" name="template" id="template">
                                    @foreach($templates as $template)
                                        <option
                                            @if ( $option->template == $template->id) selected @endif
                                        value="{{ $template->id }}">{{ $template->template_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="moderation_status" value="1"
                                           @if ($data['options']->moderation_status == true)
                                           checked
                                           @endif
                                           class="custom-control-input" id="moderation_status">
                                    <label class="custom-control-label" for="moderation_status">Enable file moderation</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane p-20" id="profile" role="tabpanel">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" name="frontpage_status" value="1"
                                       @if ($data['options']->frontpage_status == true)
                                            checked
                                       @endif
                                       class="custom-control-input" id="customControlAutosizing1">
                                <label class="custom-control-label" for="customControlAutosizing1">Enable frontpage</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="card-title">Setting alternative table in homepage</h5>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" name="enable_alternative_table_in_home" value="1"
                                       @if ($data['options']->enable_alternative_table_in_home == true)
                                       checked
                                       @endif
                                       class="custom-control-input" id="enable_alternative_table_in_home">
                                <label class="custom-control-label" for="enable_alternative_table_in_home">Enable alternative table in homepage</label>
                            </div>
                            <div class="row col-md-12">
                                <label for="count_rows_in_alternative_table" class="col-sm-2 control-label col-form-label">Number of records</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="count_rows_in_alternative_table" name="count_rows_in_alternative_table" value="{{ $data['options']->count_rows_in_alternative_table }}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="card-title">First blocks</h5>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input"
                                               @if ( $data['options']->homepage_first_status ) checked @endif
                                               name="homepage_first_status" id="homepage_first_status">
                                        <label class="custom-control-label" for="homepage_first_status">Enable block</label>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <label for="count_row_in_first_position" class="col-sm-2 control-label col-form-label">Number of records</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="count_row_in_first_position" name="count_row_in_first_position" value="{{ $data['options']->count_row_in_first_position }}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <select name="homepage_first_position" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option value="popular" @if ( $data['options']->homepage_first_position == 'popular') selected @endif>Most popular this Week</option>
                                        <option value="uploads" @if ( $data['options']->homepage_first_position == 'uploads') selected @endif>Latest Uploads</option>
                                        <option value="movies" @if ( $data['options']->homepage_first_position == 'movies') selected @endif>Weekly Popular UFR Movies</option>
                                        <option value="games" @if ( $data['options']->homepage_first_position == 'games') selected @endif>Weekly Popular UFR Games</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="card-title">Second block</h5>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input"
                                               @if ( $data['options']->homepage_second_status ) checked @endif
                                               name="homepage_second_status" id="homepage_second_status">
                                        <label class="custom-control-label" for="homepage_second_status">Enable block</label>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <label for="count_row_in_second_position" class="col-sm-2 control-label col-form-label">Number of records</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="count_row_in_second_position" name="count_row_in_second_position" value="{{ $data['options']->count_row_in_second_position }}" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <select name="homepage_second_position" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option value="popular" @if ( $data['options']->homepage_second_position == 'popular') selected @endif>Most popular this Week</option>
                                        <option value="uploads" @if ( $data['options']->homepage_second_position == 'uploads') selected @endif>Latest Uploads</option>
                                        <option value="movies" @if ( $data['options']->homepage_second_position == 'movies') selected @endif>Weekly Popular UFR Movies</option>
                                        <option value="games" @if ( $data['options']->homepage_second_position == 'games') selected @endif>Weekly Popular UFR Games</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="card-title">Third block</h5>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input"
                                               @if ( $data['options']->homepage_third_status ) checked @endif
                                               name="homepage_third_status" id="homepage_third_status">
                                        <label class="custom-control-label" for="homepage_third_status">Enable block</label>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <label for="count_row_in_third_position" class="col-sm-2 control-label col-form-label">Number of records</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="count_row_in_third_position" name="count_row_in_third_position" value="{{ $data['options']->count_row_in_third_position }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <select name="homepage_third_position" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option value="popular" @if ( $data['options']->homepage_third_position == 'popular') selected @endif>Most popular this Week</option>
                                        <option value="uploads" @if ( $data['options']->homepage_third_position == 'uploads') selected @endif>Latest Uploads</option>
                                        <option value="movies" @if ( $data['options']->homepage_third_position == 'movies') selected @endif>Weekly Popular UFR Movies</option>
                                        <option value="games" @if ( $data['options']->homepage_third_position == 'games') selected @endif>Weekly Popular UFR Games</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="card-title">Fourth block</h5>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input"
                                               @if ( $data['options']->homepage_fourth_status ) checked @endif
                                               name="homepage_fourth_status" id="homepage_fourth_status">
                                        <label class="custom-control-label" for="homepage_fourth_status">Enable block</label>
                                    </div>
                                </div>
                                <div class="row col-md-12">
                                    <label for="count_row_in_fourth_position" class="col-sm-2 control-label col-form-label">Number of records</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="count_row_in_fourth_position" name="count_row_in_fourth_position" value="{{ $data['options']->count_row_in_fourth_position }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <select name="homepage_fourth_position" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                        <option value="popular" @if ( $data['options']->homepage_fourth_position == 'popular') selected @endif>Most popular this Week</option>
                                        <option value="uploads" @if ( $data['options']->homepage_fourth_position == 'uploads') selected @endif>Latest Uploads</option>
                                        <option value="movies" @if ( $data['options']->homepage_fourth_position == 'movies') selected @endif>Weekly Popular UFR Movies</option>
                                        <option value="games" @if ( $data['options']->homepage_fourth_position == 'games') selected @endif>Weekly Popular UFR Games</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
