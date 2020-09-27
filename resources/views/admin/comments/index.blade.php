@extends('admin.template')

@section('title') Comments @endsection
@section('content')
    <form action="{{ route('admin.comments.multiselect') }}" method="post" id="multiselect">
        @csrf
    <div class="dataTables_wrapper">
        <table id="zero_config" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><label class="customcheckbox m-b-20">
                        <input type="checkbox" id="mainCheckbox">
                        <span class="checkmark"></span>
                    </label></th>
                <th>Comment</th>
                <th>Post name</th>
                <th>Status</th>
                <th>Create/edit</th>
            </tr>
            </thead>
            <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td>
                        <label class="customcheckbox">
                            <input type="checkbox" class="listCheckbox" name="checkbox_ids[]" id="checkbox_ids{{$comment->id}}" value="{{$comment->id}}" />
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td><a href="{{route('admin.comments.edit',$comment)}}">{{$comment->comment}}</a></td>
                    <td><a href="{{ route ('upload-file.show', $comment->ufrfile->slug)}}" target="_blank">{{$comment->ufrfile->name}}</a></td>
                    <td class="action-button">
                        @if($comment->moderation == 0)
                            <a href="#" class="btn btn-outline-success btn-sm change-comment-status" data-id="{{$comment->id}}"><i class="mdi mdi-eye"></i></a>
                        @else
                            <a href="#" class="btn btn-outline-secondary btn-sm change-comment-status" data-id="{{$comment->id}}"><i class="mdi mdi-eye-off"></i></a>
                        @endif
                    </td>
                    <td>{{$comment->created_at}} /<br>{{$comment->updated_at}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Pages not found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info">
                                Records {{ $comments->firstItem() }} - {{ $comments->lastItem() }} of {{ $comments->total() }} (for page {{ $comments->currentPage() }} )
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

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

            </tfoot>
        </table>
    </div>
    </form>
@endsection

@section('dropdown_menu')

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

@section('head-scripts')
    <link href="{{asset('dashboard/assets/extra-libs/multicheck/multicheck.css') }}" rel="stylesheet">
@endsection


@section('footer-scripts')
    <script src="{{asset('dashboard/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{asset('dashboard/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>

    <script>
        $('.action-button').on('click', '.change-comment-status', function(e){
            e.preventDefault();
            let obj = $(this).parent();
            $.ajax({
                type: 'post',
                url: '/admin/comments/change-status/' + $(this).data("id"),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                obj.html(data);
            }
            }).fail(function() {
                alert('Error. Try later.');
            });
        });
    </script>
@endsection