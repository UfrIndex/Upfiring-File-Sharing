<div class="info-box">

    <form action="{{ route('comment.store', $UfrFile->id ) }}" class="" method="post" id="add-comment-form" name="add-comment-form">
        @csrf
        <input type="hidden" value="{{ $UfrFile->id }}" name="ufr_files_id">
        <textarea name="comment" id="comment" rows="5" class="textarea-info" placeholder="Insert you comment here..."></textarea>
        <div class="form-group">
            <input type="submit" form="add-comment-form" class="btn btn-primary btn-submit">
        </div>
    </form>

</div>