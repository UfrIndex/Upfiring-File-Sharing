<div class="form-group">
    <label for="title">{{ __('message.title') }}</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{ $page->title ?? '' }}">
</div>

<div class="form-group">
    <label for="title" >{{ __('message.slug') }}</label>
    <input type="text" class="form-control" id="slug" name="slug" placeholder="" value="{{ $page->slug ?? "" }}">
</div>


<div class="form-group">
    <textarea id="my-editor" name="text" >{{ $page->text ?? "" }}</textarea>
</div>

<div class="form-group">
    <label for="title" >{{ __('message.description') }}</label>
    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="" value="{{ $page->meta_description ?? "" }}">
</div>

<div class="form-group row">
    <label class="col-md-2" for="" >{{ __('message.status') }}</label>
    <div class="custom-control custom-checkbox col-md-10 left-10">
        <input type="checkbox" class="custom-control-input" id="published" name="published" value="1"
               @isset($page->published)
               @if($page->published == 1)
               checked=""
                @endif
                @endisset
        >
        <label class="custom-control-label" for="published">{{ __('message.published') }}</label>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="card">
    <div class="card-body">

        <div class="input-group">
            <button type="submit" class="btn btn-primary">{{ __('message.Save') }}</button>
        </div>
