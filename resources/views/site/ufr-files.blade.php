@extends($data['template']->tempalate_path)

@section('title'){{ $title ?? $data['seo']->title }}@endsection

@section('description'){{ $data['seo']->description }}@endsection

@section('image'){{ asset('img/logo.png') }}@endsection

@section('content')
    <div class="info-box">
        <h1>@yield('title')</h1>

    <table class="ufr-file-table">
        @include('site.partials.head_table')
        @forelse($UfrFiles as $file)
            <tr>
                <td class="cell-likes-info">
                    <div class="likes-info d-none d-md-block @auth auth @else notauth @endauth" id="{{ $file->id }}">
                        <div class="count">
                            <span class="detail">
                                <span class="like">{{$file->count_likes }}</span>|<span class="dislike">{{$file->count_dislikes }}</span>
                            </span>
                        </div>
                        <div class="add-like"><span class="like" data-id="{{ $file->id }}"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> |  <span data-id="{{ $file->id }}" class="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span></div>
                    </div>

                </td>
                <td>
                    <div class="file-upload-name">
                        <a href="{{ route('upload-file.show', $file->slug ) }}">{{ $file->name }}</a>
                    </div>
                @if (route('search') == \Request::url())
                    <div class="user-upload">Upload: {{ $file->user->name }}</div>
                @endif
                </td>
                <td  class="d-none d-md-block">
                    @foreach($file->categories as $category)
                        <a href="{{ route("category.show", $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                </td>
                <td class="d-none d-md-block">
                    <div class="align-middle">
                        <span class="seeds">{{ $file->seeds }}</span>/<span class="peers">{{ $file->peers }}</span>
                    </div>
                </td>
                <td>{{ $file->price }} ufr</td>
                <td class="d-none d-md-block"><span class="date">{{ date('M d, Y', strtotime($file->created_at)) }}</span></td>
                <td><span class="size">{{ $file->size }}</span></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">
                    Files not found
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
    @if (isset($get_param))
    {{ $UfrFiles->appends($get_param)->links() }}
    @elseif($UfrFiles->links())
       {{ $UfrFiles->links() }}
    @endif
    </div>
@endsection
