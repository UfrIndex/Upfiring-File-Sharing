@extends($data['template']->tempalate_path)

@section('title'){{ 'Home' }}@endsection
@section('description'){{ $data['seo']->description }}@endsection

@section('image'){{ asset('img/logo.png') }}@endsection

@section('content')
    <img src="/img/logo.png" alt="">
@endsection
