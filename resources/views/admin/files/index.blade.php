@extends('admin.template')

@section('title') {{ __('message.ufr_files') }} @endsection
@section('content')
    <form action="{{route('admin.files.index')}}" name="findFiles">
        <div class="dataTables_wrapper">
            <div class="form-group row">
                <label class="col-md-2">Show witch status:</label>
                <div class="col-md-3">
                    <select name="show" class="select2 form-control custom-select select2-hidden-accessible" >
                        <optgroup>
                            <option>All</option>
                            <option value="hidden"
                            @if ($show == 'hidden')
                                selected
                            @endif
                            >Hidden</option>
                            <option value="show"
                            @if ($show == 'show')
                            selected
                             @endif
                            >Show</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-1 text-right">
                    <label>Find</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="find" value="{{ $find ?? "" }}">
                </div>
                <div class="col-md-2"><button type="submit" class="btn btn-dark">Sort</button></div>
            </div>
        </div>
    </form>
    <form action="{{ route('admin.files.multiselect') }}" method="post" id="multiselect">
        @csrf
    <div class="dataTables_wrapper">

        <table id="zero_config" class="table table-striped table-bordered">
            <thead class="thead-light">
            <tr>
                <th>
                    <label class="customcheckbox m-b-20">
                        <input type="checkbox" id="mainCheckbox">
                        <span class="checkmark"></span>
                    </label>
                </th>
                <th>Name</th>
                <th>Slug</th>
                <th>Uploaded by</th>
                <th>Status</th>
                <th>Create/edit</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($ufrFiles as $ufrFile)
                <tr>
                    <td>
                        <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox" name="checkbox_ids[]" id="checkbox_ids{{$ufrFile->id}}" value="{{$ufrFile->id}}" />
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="{{ route('upload-file.show', $ufrFile->slug) }}">{{$ufrFile->name}}</a></td>
                    <td>{{$ufrFile->slug}}</td>
                    <td>{{$ufrFile->user->name}}</td>
                    <td>
                        @if($ufrFile->visible == 1)
                            <a href="#" class="btn btn-outline-success btn-sm change-file-status" data-id="{{$ufrFile->id}}"><i class="mdi mdi-eye"></i></a>
                        @else
                            <a href="#" class="btn btn-outline-secondary btn-sm change-file-status" data-id="{{$ufrFile->id}}"><i class="mdi mdi-eye-off"></i></a>
                        @endif
                    </td>
                    <td>{{$ufrFile->created_at}} /<br>{{$ufrFile->updated_at}}</td>
                    <td class="action-button">
                        <a class="btn btn-outline-warning btn-sm" href="{{route('admin.files.edit',$ufrFile)}}"><i class="mdi mdi-grease-pencil"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Pages not found</td>
                </tr>
            @endforelse

            <tr>
                <td colspan="7">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info">
                                Records {{ $ufrFiles->firstItem() }} - {{ $ufrFiles->lastItem() }} of {{ $ufrFiles->total() }} (for page {{ $ufrFiles->currentPage() }} )
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                {!! $ufrFiles->appends($get_param)->links() !!}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            </tbody>
            <tfooter>
                <tr>

                    <td colspan="7">
                        <div class="row">
                            <label class="col-md-2"><b>Selected: </b></label>
                            <div class="col-md-8">
                                <select name="action" class="select2 form-control custom-select" >
                                    <option></option>
                                    <option value="show">Show</option>
                                    <option value="hide">Hide</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" form="multiselect" id="multiselect-submit" value="Submit">Change status</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tfooter>
        </table>


    </div>
    </form>
@endsection

@section('dropdown_menu')
    @include('admin.pages.partials.drop_menu')
@endsection

@section('footer-scripts')
    <script src="{{asset('dashboard/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{asset('dashboard/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script>
        $('multiselect-submit').click(function () {
            $( "#multiselect" ).submit();
        });
    </script>
@endsection

@section('head-scripts')
    <link href="{{asset('dashboard/assets/extra-libs/multicheck/multicheck.css') }}" rel="stylesheet">
@endsection

@section('css')
    <link href="{{asset('admin-files/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <style>
        .inline {
            display: flex;
        }
        .inline a {
            margin-right: 5px;
        }
    </style>
@endsection
