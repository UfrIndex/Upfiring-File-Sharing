@extends('admin.template')

@section('title') Pages @endsection
@section('content')
    <form action="{{ route('admin.pages.multiselect') }}" method="post" id="multiselect">
        @csrf
    <div class="dataTables_wrapper">
        <table id="zero_config" class="table table-striped table-bordered">
            <thead class="thead-light">
            <tr>
                <th><label class="customcheckbox m-b-20">
                        <input type="checkbox" id="mainCheckbox">
                        <span class="checkmark"></span>
                    </label></th>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Create/edit</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($pages as $page)
                <tr>
                    <td>
                        <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox" name="checkbox_ids[]" id="checkbox_ids{{$page->id}}" value="{{$page->id}}" />
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{$page->title}}</td>
                    <td>{{$page->slug}}</td>
                    <td>
                        @if($page->published == 1)
                            Published
                        @else
                            Hidden
                        @endif
                    </td>
                    <td>{{$page->created_at}} /<br>{{$page->updated_at}}</td>
                    <td class="action-button">
                        <a class="btn btn-outline-warning btn-sm" href="{{route('admin.pages.edit',$page)}}"><i class="mdi mdi-grease-pencil"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Pages not found</td>
                </tr>
            @endforelse
            <tbody>
            <tr>
                <td colspan="7">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info">
                                Records {{ $pages->firstItem() }} - {{ $pages->lastItem() }} of {{ $pages->total() }} (for page {{ $pages->currentPage() }} )
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                {{ $pages->links() }}
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
                            <b>Selected: </b><select name="action" class="select2 form-control custom-select" >
                                <option></option>
                                <option value="show">Show</option>
                                <option value="hide">Hide</option>
                                <option value="delete">Delete</option>
                            </select>
                            <button form="multiselect" id="multiselect-submit" value="Submit">Submit</button>
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