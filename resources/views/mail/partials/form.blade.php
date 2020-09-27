<form action="{{ route('sender-mail') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" class="input-name" name="name" id="name" placeholder="Your Name (required)" required="">
    </div>
    <div class="form-group">
        <input type="email" class="input-name" name="email" id="email" required="" placeholder="Your Email (required)">
    </div>
    <div class="form-group">
        <input type="text" class="input-name" name="subject" id="subject" placeholder="Subject">
    </div>
    <div class="form-group">
        <textarea type="text" placeholder="Message" class="textarea-info" rows="5" name="message" id="info"></textarea>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div>
            @if ($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback"  role="alert" style="display: block">{{$errors->first('g-recaptcha-response')}}</span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-submit" value="Submit">
    </div>
</form>