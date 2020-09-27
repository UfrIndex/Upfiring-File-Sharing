@extends($data['template']->tempalate_path)

@section('title'){{ $page->title ?? $data['seo']->title }}@endsection
@section('description'){{ $page->meta_description ?? $data['seo']->description }}@endsection
@section('image'){{ asset('img/logo.png') }}@endsection

@section('content')

    @if ($data['options']->homepage_first_status)
    @include ('site.partials.block_on_homepage.'.$data['options']->homepage_first_position, ['count' =>$data['options']->count_row_in_first_position])
    @endif

    @if ($data['options']->homepage_second_status)
        @include ('site.partials.block_on_homepage.'.$data['options']->homepage_second_position, ['count' =>$data['options']->count_row_in_second_position])
    @endif

    @if ($data['options']->homepage_third_status)
        @include ('site.partials.block_on_homepage.'.$data['options']->homepage_third_position, ['count' =>$data['options']->count_row_in_third_position])
    @endif

    @if ($data['options']->homepage_fourth_status)
        @include ('site.partials.block_on_homepage.'.$data['options']->homepage_fourth_position, ['count' =>$data['options']->count_row_in_fourth_position])
    @endif

@endsection

