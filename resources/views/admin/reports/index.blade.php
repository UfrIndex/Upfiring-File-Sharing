@extends('admin.template')

@section('title') Reports @endsection
@section('content')

    <form action="{{ route('admin.files.multiselect') }}" method="post" id="multiselect">
        @csrf
        <div class="dataTables_wrapper">

            <table id="zero_config" class="table table-striped table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>File name</th>
                    <th>Status</th>
                    <th>User</th>
                    <th colspan="2">File action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td><strong><a href="{{ route('upload-file.show', $report->ufrfile->slug) ?? ""}}">{{ $report->ufrfile->name ?? "" }}</a></strong><br />
                        <strong>Uploaded:</strong> <a href="{{route('admin.user.edit', $report->ufrfile->user ) ?? "#"}}">{{ $report->ufrfile->user->name ?? "" }}</a></td>
                        <td><strong>Reason:</strong> {{$report->type}}<br>
                            {{$report->text}}</td>
                        <td>{{$report->user->name}}</td>
                        <td class="action-button">
                            <a class="btn btn-outline-warning btn-sm" href="{{route('admin.files.edit',$report->ufrfile)}}"><i class="mdi mdi-grease-pencil"></i></a>
                        </td>
                        <td class="action-button">
                            <form onsubmit="if(confirm('Delete file?')){return true}else{return false}" action="{{route('admin.files.destroy',$report->ufrfile)}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Reports not found</td>
                    </tr>
                @endforelse

                </tbody>

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
