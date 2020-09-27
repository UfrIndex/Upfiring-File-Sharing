@extends('admin.template')


@section('title')
    {{ __('message.users') }}
@endsection

@section('dropdown_menu')

@endsection

@section('content')

    <form action="{{ route('admin.user.index') }}">
    <div class="form-group row">
        <div class="col-md-3">
            <select name="role" class="select2 form-control custom-select select2-hidden-accessible">
                <option>All</option>
                @foreach($roles as $role)
                    <option @if(request('role') == $role->id) selected @endif value="{{$role->id}}">{{ $role->display_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="sort" class="select2 form-control custom-select select2-hidden-accessible">
                <option value="name" @if(request('sort') == 'name') selected @endif>Sort by name</option>
                <option value="email" @if(request('sort') == 'email') selected @endif>Sort by email</option>
                <option value="role_id" @if(request('sort') == 'roles') selected @endif>Sort by roles</option>
                <option value="id" @if(request('sort') == 'id') selected @endif>Sort by id</option>
            </select>
        </div>
        <div class="col-md-1 text-right">
            <label>Find</label>
        </div>
        <div class="col-md-3">
            <input type="text" name="find" value="{{ request()->get('find') ?? '' }}">
        </div>
        <div class="col-md-2"><button type="submit" class="btn btn-dark">Sort</button></div>
    </div>
    </form>
    <div class="table-responsive">
        <div class="dataTables_wrapper container-fluid dt-bootstrap4">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('message.name') }}</th>
                    <th scope="col">{{ __('message.E-Mail-Address') }}</th>
                    <th scope="col">{{ __('message.role') }}</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td class="action-button">
                            <a class="btn btn-outline-warning btn-sm" href="{{route('admin.user.edit',$user)}}"><i class="mdi mdi-grease-pencil"></i></a>
                        </td>
                        <td class="action-button">
                            <form onsubmit="if(confirm('Delete user?')){return true}else{return false}" action="{{route('admin.user.destroy',$user)}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">{{ __('message.Not_found') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="zero_config_info" role="status" aria-live="polite">
                        {{ __('message.records', ['firstItem' => $users->firstItem(), 'lastItem' => $users->lastItem(), 'total' => $users->total(), 'currentPage' => $users->currentPage()  ]) }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            {{ $users->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
