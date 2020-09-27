@extends($data['template']->tempalate_path)

@section('title')
    {{ $title }}
@endsection

@section('image'){{ asset('img/logo.png') }}@endsection

@section('content')
    <div class="info-box">
        <h1>@yield('title')</h1>


    <table class="ufr-file-table">
        <thead>
        <tr>
            <th>User</th>
            <th>Count upload</th>
        </tr>
        </thead>
        <tbody>

        @foreach($keys_users_id as $user_id => $count_files)
            @foreach($top_users as $top_user)
                @if ($user_id == $top_user->id)
                    <tr>
                        <td><a href="{{ route('userFiles', $top_user->id) }}">{{ $top_user->name }}</a></td>
                        <td>{{ $count_files }} ufr</td>
                    </tr>
                @endif
            @endforeach
        @endforeach

        </tbody>
    </table>
    </div>
@endsection
