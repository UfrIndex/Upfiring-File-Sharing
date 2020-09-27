<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $data['seo']->title ?? 'Home' }}</title>
    <meta name="title" content="{{ $data['seo']->title ?? 'Home' }}">
    <meta name="description" content="{{ $data['seo']->description }}">

    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:title" content="{{ $data['seo']->title ?? 'Home' }}">
    <meta property="og:description" content="{{ $data['seo']->description }}">
    <meta property="og:image" content="{{ asset('img/logo.png') }}" />
    <meta property="og:image:alt" content="{{ $data['seo']->title ?? 'Home' }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />

    <meta property="twitter:card" content="{{ $data['seo']->description }}" />
    <meta property="twitter:title" content="{{ $data['seo']->title ?? 'Home' }}" />
    <meta property="twitter:description" content="{{ $data['seo']->description }}" />
    <meta property="twitter:domain" content="{{ request()->getHost() }}" />
    <meta property="twitter:image:src" content="{{ asset('img/logo.png') }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/solid.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/brands.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=5" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {!! $header_script !!}
</head>
<body>
<div class="content">
    <header class="header-section">
        <div class="container">

            <a class="site-logo" href="/home">
                <img src="/img/logo.png" alt="logo">
            </a>
            <div class="user-panel">

                @guest
                    <a href="{{ route('login') }}">{{ __('Login') }}</a> / <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @endguest


            </div>

            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>

            <nav class="main-menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/what-is-upfiring">What is Upfiring</a></li>
                    <li><a href="/earn-for-seeding">Earn for Seeding</a></li>
                    <li><a href="/how-to-upload-upfiring-files">How to Upload</a></li>
                    <li><a href="{{ route('upload-file.create') }}">Upload a File</a></li>
                </ul>
                <ul class="mobile-menu">
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a> / <a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                            </a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>


    <section class="footer-top-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 content-block" id="content-block">
                    <div class="left-block" id="left-block">
                        @if ( $data['advertisings']->show_homepage_banner_left_and_right && $data['advertisings']->enable_banner_banner_left_and_right )
                        @if ($banners->banner_left != '')
                            <div class="bnr" id="left-block-bnr">
                                {!!   $banners->banner_left ?? '' !!}
                            </div>
                        @endif
                        @endif
                    </div>
                    <span id="content">
                        @if ( $data['advertisings']->show_homepage_content_top && $data['advertisings']->enable_content_top )
                            <div class="bnr-center">
                                {!!   $banners->content_top ?? '' !!}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="logo-text">
                                    <a href="{{route('search')}}"><img src="/img/logo.png" alt=""></a>
                                </div>
                            </div>
                        </div>


                        @include ('site.partials.search_min')

                        <div class="row d-flex justify-content-between icon-block">

                            <a href="home?category=1"><span class="circle"><i class="fas fa-venus-mars"></i></span><div>Adult</div></a>
                            <a href="home?category=2"><span class="circle"><i class="fab fa-windows"></i></span><div>Applications</div></a>
                            <a href="home?category=3"><span class="circle"><i class="fa fa-music" aria-hidden="true"></i></span><div>Audio</div></a>
                            <a href="home?category=4"><span class="circle"><i class="fa fa-book" aria-hidden="true"></i></span><div>E-Books</div></a>
                            <a href="home?category=5"><span class="circle"><i class="fa fa-gamepad" aria-hidden="true"></i></span><div>Games</div></a>
                            <a href="home?category=7"><span class="circle"><i class="fab fa-js-square"></i></span><div>Scripts, plugins, themes</div></a>
                            <a href="home?category=8"><span class="circle"><i class="fas fa-video"></i></span><div>Video</div></a>
                            <a href="home?category=9"><span class="circle"><i class="fa fa-film" aria-hidden="true"></i></span><div>Movies</div></a>
                            <a href="home?category=10"><span class="circle"><i class="fas fa-compact-disc"></i></span><div>x265 BluRay Encodes</div></a>

                        </div>

                    </span>
                    <div class="content-bottom-mobile">
                        <div class="mobile-block">
                            @if ( $data['advertisings']->show_homepage_banner_left_and_right && $data['advertisings']->enable_banner_banner_left_and_right )
                            @if ($banners->banner_left != '')
                                <div class="bnr">
                                    {!! $banners->banner_left ?? '' !!}
                                </div>
                            @endif
                            @endif
                        </div>
                        <div class="right-block">
                            @if ( $data['advertisings']->show_homepage_banner_left_and_right && $data['advertisings']->enable_banner_banner_left_and_right )
                            @if ($banners->banner_right != '')
                                <div class="bnr" id="right-block-bnr">
                                    {!! $banners->banner_right ?? '' !!}
                                </div>
                            @endif
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>



@include ('site.partials.footer')



<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/forms.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
@include ('site.partials.popup-categories')
@auth
@else
    <script>
        $('.notauth .add-like .like').on('click', function () {
            $('#errorModal').toggleClass('show').toggle();
            $('body').css('overflow','auto');
        });
        $('.notauth .add-like .dislike').on('click', function () {
            $('#errorModal').toggleClass('show').toggle();
            $('body').css('overflow','auto');
        });

        $('.close-error-modal').on('click', function () {
            $('#errorModal').toggleClass('show').toggle();
            $('body').css('overflow','auto');
        });
    </script>
@endauth
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
