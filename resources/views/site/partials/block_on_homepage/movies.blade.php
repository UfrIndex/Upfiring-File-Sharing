<div class="info-box">
    <h2>Weekly Popular UFR Movies </h2>

    <table class="ufr-file-table">
        <thead>
        <tr>
            <th colspan="2">UFR Files</th>
            <th class="d-none d-xl-block">S/P</th>
            <th>Price</th>
            <th class="date d-none d-xl-block">Date</th>
            <th class="size">Size</th>
        </tr>
        </thead>
        <tbody>

        @foreach($keys_top as $key)
            @for ($i = 0; $i < $count; $i++)
                @if ( $i < count($top_movies) )
                    @if ($key == $top_movies[$i]->id)
                        <tr>
                            <td class="cell-likes-info">
                                <div class="likes-info d-none d-xl-block @auth auth @else notauth @endauth" id="{{ $top_movies[$i]->id }}">
                                    <div class="count">
                                    <span class="detail">
                                        <span class="like">{{$top_movies[$i]->count_likes }}</span>|<span class="dislike">{{$top_movies[$i]->count_dislikes }}</span>
                                    </span>
                                    </div>
                                    <div class="add-like"><span class="like" data-id="{{ $top_movies[$i]->id }}"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> |  <span data-id="{{ $top_movies[$i]->id }}" class="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span></div>
                                </div>

                            </td>
                            <td>
                                <div class="file-upload-name">
                                    <a href="{{ route('upload-file.show', $top_movies[$i]->slug ) }}">{{ $top_movies[$i]->name }}</a>
                                </div>
                                @if (route('search') == \Request::url())
                                    <div class="user-upload">Upload: {{ $top_movies[$i]->user->name }}</div>
                                @endif
                            </td>
                            <td class="d-none d-xl-block">
                                <div class="align-middle">
                                    <span class="seeds">{{ $top_movies[$i]->seeds }}</span>/<span class="peers">{{ $top_movies[$i]->peers }}</span>
                                </div>
                            </td>
                            <td>{{ $top_movies[$i]->price }} ufr</td>
                            <td class="d-none d-xl-block"><span class="date">{{ date('M d, Y', strtotime($top_movies[$i]->created_at)) }}</span></td>
                            <td><span class="size">{{ $top_movies[$i]->size }}</span></td>
                        </tr>
                    @endif
                @endif
            @endfor
        @endforeach

        </tbody>
    </table>

</div>
