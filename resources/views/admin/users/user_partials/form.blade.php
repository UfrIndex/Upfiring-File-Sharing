<div class="form-group m-t-20">
    <label>{{ __('message.name') }}</label>
    <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $user->name ?? '' }}" required="" >
</div>
<div class="form-group">
    <label>{{ __('message.E-Mail-Address') }}</label>
    <input id="email" type="email"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? $user->email ?? '' }}" required="" disabled>
</div>
<div class="form-group">
    <label>{{ __('message.role') }}</label>
    <select name="role" class="select2 form-control custom-select">
        @foreach($roles as $role)
            <option @if(isset($user->role_id)) @if ( $role->id == $user->role_id) selected @endif @endif value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group row">
    <label class="col-md-2" for="" >Allow comments without moderation</label>
    <div class="custom-control custom-checkbox col-md-10 left-10">
        <input type="checkbox" class="custom-control-input" id="comments_access" name="comments_access" value="1"
               @isset($user->comments_access)
               @if($user->comments_access == 1)
               checked=""
                @endif
                @endisset
        >
        <label class="custom-control-label" for="comments_access"> </label>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-2" for="" >Allow upload UFR files without moderation</label>
    <div class="custom-control custom-checkbox col-md-10 left-10">
        <input type="checkbox" class="custom-control-input" id="ufr_files_access" name="ufr_files_access" value="1"
               @isset($user->ufr_files_access)
               @if($user->ufr_files_access == 1)
               checked=""
                @endif
                @endisset
        >
        <label class="custom-control-label" for="ufr_files_access"> </label>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <div class="input-group">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </div>
</div>