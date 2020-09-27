<section class="page-section community-page set-bg">
    <div class="community-top-title">
        Comments
    </div>

    <ul class="community-post-list" id="comments-list">
        @if (isset( $comments ))
            @foreach($comments as $comment)
                <li>
                    <div class="community-post">

                        <div class="post-content">
                            <h5>{{ $comment->user->name }}<span> {{ date('M d, Y', strtotime($comment->created_at)) }}</span></h5>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                </li>
            @endforeach

        @endif

    </ul>
</section>
