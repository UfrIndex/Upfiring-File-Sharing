@extends($data['template']->tempalate_path)

@section('title'){{ $UfrFile->name }}@endsection


@section('description'){{ $UfrFile->info }}@endsection

@section('image')
@if ($UfrFile->image == '')
{{ asset('img/logo.png') }}@else{{ asset("storage/$UfrFile->image") }}
@endif
@endsection

@section('author')
@foreach($UfrFile->categories as $category){{ $category->name }}, @endforeach
@endsection

@section('category'){{ $user->name }}@endsection

@section('content')

    <div class="info-box single-info-box">
        <div class="row">

            <div class="col-md-12">
                <div class="table-file-info">
                    <div class="likes-info-in-file text-center @auth auth-in-file @else notauth @endauth">
                        @if ($UfrFile->image == '')
                            <img src="/img/logo.png" style="max-height: 350px;" alt="no-image">
                        @else
                            <img src="/storage/{{ $UfrFile->image }}" style="max-height: 350px;" alt="{{ $UfrFile->name }}">
                        @endif
                        <div class="add-like"><span class="like" data-id="{{ $UfrFile->id }}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$UfrFile->count_likes }}</span> |  <span data-id="{{ $UfrFile->id }}" class="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{$UfrFile->count_dislikes }}</span></div>
                    </div>
                    <div class="right-info">
                        @guest
                            <a href="#" data-id="{{ $UfrFile->id }}" class="btn btn-primary btn-sm" id="errorReport">Report</a>
                        @else
                            @if ($report == 0 )
                            <a href="#" data-id="{{ $UfrFile->id }}" class="btn btn-primary btn-sm" id="ModalReportForm">Report</a>
                            @endif
                        @endguest

                        <ul class="file-info-list">
                            <li class="title"><h1>@yield('title')</h1></li>
                            <li><span>Category:</span>

                                @foreach($UfrFile->categories as $category)
                                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>,
                                @endforeach</li>
                            <li><span>Author:</span> {{ $user->name }}</li>
                            <li><span>Price:</span> {{ $UfrFile->price }}</li>
                            <li><span>Pieces:</span> {{ $UfrFile->pieces }}</li>
                            <li><span>Creation date:</span> {{ date('M d, Y', strtotime($UfrFile->created_at)) }}</li>
                            <li><span>File:</span> {{ $UfrFile->encfile }}</li>
                            <li><span>Size:</span> {{ $UfrFile->size }} MB</li>
                            <li class="d-none d-sm-block"><span>Owner:</span> {{ $UfrFile->owner }}</li>
                            <li><span>Info:</span> {{ $UfrFile->info }}</li>
                            <li><span>Seeds/Peers:</span> <span class="seeds">{{ $UfrFile->seeds }}</span>/<span class="peers">{{ $UfrFile->peers }}</span></li>

                            @if ($UfrFile->visible == 0 && $moderation_status == true)
                                <li class="alert-info"><span>Warning:</span> The file will be published after being moderated</li>
                            @else
                                <li><span>Download:</span> <a href="{{ route('download-file', $UfrFile->slug ) }}">{{ $UfrFile->name }}</a></li>
                            @endif

                            @auth
                            @if ($UfrFile->user_id == Auth::user()->id or  Auth::user()->role_id > 1 )
                                <li><span class="btn btn-danger delete-file" data-id="{{ $UfrFile->id }}" id="{{ $UfrFile->id }}" style="padding: 0;">Delete</span></li>
                            @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    @include ('site.partials.comments')
    @auth
        @include ('site.partials.add-comment-form')
    @else
        <div class="alert alert-danger" role="alert">
            You must be <a href="{{ route('register') }}">registered</a>/<a href="{{ route('login') }}">logged</a> in user to leave a comment
        </div>
    @endauth
    </div>
@endsection

@section('script')
    <script>
        window.onload = function() {
            var xhr = new XMLHttpRequest();

            xhr.open('POST', '/update-seeders/{{ $UfrFile->id }}', false);
            xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
            xhr.send();

            if (xhr.status === 200) {
                let answer = JSON.parse(xhr.response);

                if(answer.answer == true) {
                    document.getElementsByClassName('seeds')[0].innerHTML = answer.data.seeds
                    document.getElementsByClassName('peers')[0].innerHTML = answer.data.peers
                }
                //console.log( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
            } else {
                console.log(xhr.error);
                //document.getElementById("red-button").innerHTML = "Code: " + xhr.responseText;
            }
        }
    </script>
@endsection
