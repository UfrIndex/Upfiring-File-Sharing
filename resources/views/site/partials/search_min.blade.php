<section class="search">
    @if ( app('request')->input('s') )
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('search') }}" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="s" placeholder="Search file" value="{{ app('request')->input('s') }}" aria-label="Search file" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary " type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</section>
