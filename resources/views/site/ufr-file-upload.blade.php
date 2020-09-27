@extends($data['template']->tempalate_path)

@section('title')
    Upload UFR
@endsection

@section('content')
    <div class="info-box">
        <h1>@yield('title')</h1>
    <form method="POST" action="{{ route('upload-file.store') }}"  class="md-form"  enctype="multipart/form-data">
        @csrf
        <div class="label-upload">Name:</div>
        <div class="custom-file">
            <input type="text" class="input-name" name="name" id="name" value="{{ old('name') }}" required >
            @if ($errors->has('name'))
                <span class="invalid-feedback"  role="alert" style="display: block">{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="label-upload">UFR file:</div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="ufrfile" value="{{ old('ufrfile') }}" id="exampleFormControlFile1" required>
            <label id="labelexampleFormControlFile1" class="custom-file-label" for="exampleFormControlFile1">Choose file...</label>
            <span class="name-file"></span>

            @if ($errors->has('ufrfile'))
                <span class="invalid-feedback"  role="alert" style="display: block">The ufrfile must be of file type: .ufr </span>
            @endif

        </div>
        <div class="label-upload">Categories:</div>
        <div>

            @foreach( $categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="category[]" id="checkbox-{{ $category->slug }}" value="{{ $category->id }}" >
                    <label class="form-check-label" for="checkbox-{{ $category->slug }}">{{ $category->name }}</label>
                </div>
            @endforeach
                @if ($errors->has('category'))
                    <span class="invalid-feedback"  role="alert" style="display: block">{{$errors->first('category')}}</span>
                @endif
        </div>

        <div class="label-upload">Image:</div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="poster" id="poster" value="{{ old('poster') }}" accept="image/jpeg,image/png,image/gif">
            <label id="labelposter" class="custom-file-label" for="poster">Choose poster...</label>
            <span class="name-poster"></span>
            @if ($errors->has('poster'))
                <span class="invalid-feedback"  role="alert" style="display: block">{{$errors->first('poster')}}</span>
            @endif
        </div>
        <div class="label-upload">Info:</div>
        <div class="custom-file">
            <textarea type="text" placeholder="If left blank, the information will be obtained from the UFR file" class="textarea-info" rows="5" name="info" id="info" >{{ old('info') }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-submit" value="Submit">
        </div>

    </form>
    </div>
@endsection
