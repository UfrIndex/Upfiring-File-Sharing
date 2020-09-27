@extends($data['template']->tempalate_path)

@section('title') {{ $title }} @endsection

@section('content')
    <div class="info-box">
        <h1>@yield('title')</h1>
    {{ $mail }}
    </div>
@endsection
