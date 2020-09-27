<section class="searsh-section baner">
    <div class="container-full">
        @if ( $data['advertisings']->enable_banner_top )
            <div class="row @if ($banners->banner_top != '') baner @endif ">
                <div class="col-md-12">
                    @if ($banners->banner_top != '')
                        <div class="text-center">
                            {!! $banners->banner_top !!}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="search-box-text">Search
                    | <span id="categoriesModal">Categories</span>
                    | <a href="{{ route('upload-file.create') }}">Upload UFR</a>
                    | <a href="{{ route('top10files') }}">Top 10 Files</a>
                    | <a href="{{ route('top-uploaders') }}">Top Uploaders</a>
                    | {{ $count_ufr_files }} UFR files</div>

                <form action="{{ route('search') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" placeholder="Search file" value="{{ app('request')->input('s') }}" aria-label="Search file" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="all_category" value="all" checked>
                            <label class="form-check-label" for="all_category">All</label>
                        </div>
                    @foreach( $categories as $category)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" id="{{ $category->slug }}" value="{{ $category->id }}"
                            @if (app('request')->input('category') == $category->id )
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="{{ $category->slug }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach

                </form>
            </div>
        </div>
    </div>
</section>
