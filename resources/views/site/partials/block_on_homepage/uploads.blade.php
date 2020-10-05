
<div class="info-box">
    <h2>Latest Uploads </h2>

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
        @for ($i = 0; $i < $count; $i++)
            <tr>
                <td class="cell-likes-info">
                    <div class="likes-info d-none d-xl-block @auth auth @else notauth @endauth" id="{{  $last_upload[$i]->id }}">
                        <div class="count">
                                <span class="detail">
                                    <span class="like">{{ $last_upload[$i]->count_likes }}</span>|<span class="dislike">{{ $last_upload[$i]->count_dislikes }}</span>
                                </span>
                        </div>
                        <div class="add-like"><span class="like" data-id="{{  $last_upload[$i]->id }}"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> |  <span data-id="{{  $last_upload[$i]->id }}" class="dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i></span></div>
                    </div>

                </td>
                <td>
                    <div class="file-upload-name">
                        <a href="{{ route('upload-file.show',  $last_upload[$i]->slug ) }}">{{  $last_upload[$i]->name }}</a>
                    </div>
                    @if (route('search') == \Request::url())
                        <div class="user-upload">Upload: {{  $last_upload[$i]->user->name }}</div>
                    @endif
                </td>
                <td class="d-none d-xl-block">
                    <div class="align-middle">
                        <span class="seeds">{{  $last_upload[$i]->seeds }}</span>/<span class="peers">{{  $last_upload[$i]->peers }}</span>
                    </div>
                </td>
                <td>{{  $last_upload[$i]->price }} ufr</td>
                <td class="d-none d-xl-block"><span class="date">{{ date('M d, Y', strtotime( $last_upload[$i]->created_at)) }}</span></td>
                <td><span class="size">{{  $last_upload[$i]->size }}</span></td>
            </tr>
        @endfor

        </tbody>
    </table>

</div>
