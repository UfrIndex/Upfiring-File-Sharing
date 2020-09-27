<div class="form-group">
    <label for="name">{{ __('message.title') }}</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $file->name ?? '' }}">
</div>

<div class="form-group">
    <textarea id="my-editor" class="form-control" rows="7" name="info" >{{ $file->info ?? "" }}</textarea>
</div>

<div class="form-group row">
    <label class="col-md-2" for="" >{{ __('message.status') }}</label>
    <div class="custom-control custom-checkbox col-md-10 left-10">
        <input type="checkbox" class="custom-control-input" id="visible" name="visible" value="1"
               @isset($file->visible)
               @if($file->visible == 1)
               checked=""
                @endif
                @endisset
        >
        <label class="custom-control-label" for="visible">{{ __('message.published') }}</label>
    </div>
</div>

<div class="label-upload">Image:</div>
<div class="custom-file">
    <input type="file" class="custom-file-input" name="poster" id="poster" accept="image/jpeg,image/png,image/gif">
    <label id="labelposter" class="custom-file-label" for="poster">Choose poster...</label>
    <span class="name-poster"></span>
</div>

<div class="card">
    <div class="card-body">

        <div class="input-group">
            <button type="submit" class="btn btn-primary">{{ __('message.Save') }}</button>
        </div>