@extends($data['template']->tempalate_path)

@section('title'){{ $page->title ?? $data['seo']->title }}@endsection
@section('description'){{ $page->meta_description ?? $data['seo']->description }}@endsection
@section('image'){{ asset('img/logo.png') }}@endsection

@section('content')
    <div class="info-box">
        <h1>@yield('title')</h1>
        {!! $page->text !!}
    </div>

@endsection
