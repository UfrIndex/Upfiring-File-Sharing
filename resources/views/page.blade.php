@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('upload-file.store') }}"  enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input name="ufrfile" type="file" class="form-control-file" id="ufrfile">
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                        <form name="search" id="searchForm" action="{{ route('search') }}">
                            @csrf

                            <div class="form-group">
                                <input name="ufrfile" type="file" class="form-control-file" id="ufrfile">
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script async>
            window.onload = function() {
                const element = document.querySelector('form#searchForm');
                element.addEventListener('submit', event => {
                    event.preventDefault();
                    search_send();
                });
            };

            function search_send() {
                let xmlhttp = new XMLHttpRequest(), method = "GET", url = "{{ route('search')}}";
                var ur = '';
                xmlhttp.open("GET", "{{ route('search')}}", true);
                xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        ur = this.responseText;
                    }
                    else if ( this.status == 404 ) {
                        ur = 'error';
                    }

                };
                xmlhttp.send();
                console.log(ur);
            }


        </script>
    </div>


@endsection
