<div class="form-group">
    <textarea id="my-editor" class="form-control" rows="7" name="comment" >{{ $comment->comment ?? "" }}</textarea>
</div>

<div class="form-group row">
    <label class="col-md-2" for="" >{{ __('message.status') }}</label>
    <div class="custom-control custom-checkbox col-md-10 left-10">
        <input type="checkbox" class="custom-control-input" id="moderation" name="moderation" value="1"
               @isset($comment->moderation)
               @if($comment->moderation == 0)
               checked=""
                @endif
                @endisset
        >
        <label class="custom-control-label" for="moderation">{{ __('message.published') }}</label>
    </div>
</div>


<div class="card">
    <div class="card-body">

        <div class="input-group">
            <button type="submit" class="btn btn-primary">{{ __('message.Save') }}</button>
        </div>