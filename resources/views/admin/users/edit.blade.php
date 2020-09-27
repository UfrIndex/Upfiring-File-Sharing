@extends('admin.template')

@section('title')
    {{ __('message.change_user') }}
@endsection
<link href="{{asset('dashboard/assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@section('head-scripts')

@endsection

@section('dropdown_menu')

@endsection

@section('content')

    <div class="card-body">
        <form action="{{ route('admin.user.update', $user) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            @method('PUT')
            @include('admin.users.user_partials.form')
        </form>
    </div>

@endsection

@section('')
    <script src="{{asset('dashboard/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/select2/dist/js/select2.min.js')}}"></script>
@endsection