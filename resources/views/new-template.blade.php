<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="title" content="@yield('title')">
    @include('site.partials.footer_seo')

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
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

            <a class="site-logo" href="/">
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
                    @include ('site.partials.header_menu')
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

    @if ($data['options']->frontpage_status != true or (url()->full() != route('home')) )
        @include ('site.partials.search-section')
    @endif

    <section class="footer-top-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 content-block" id="content-block">
                    <div class="left-block">
                        @if ( $data['advertisings']->enable_banner_banner_left_and_right )
                        @if ($banners->banner_left != '')
                        <div class="bnr" id="left-block-bnr">
                            {!!   $banners->banner_left ?? '' !!}
                        </div>
                        @endif
                        @endif
                    </div>
                    <span id="content">

                        @if ($banners->content_top != '')
                            @if ( $data['advertisings']->enable_content_top )
                            <div class="bnr-center">
                                {!!   $banners->content_top ?? '' !!}
                            </div>
                            @endif
                        @endif
                            @if ( \Route::currentRouteName() == 'search' and isset($home) )
                                @include('site.partials.home_page')

                            @else
                                @yield('content')
                            @endif

                    </span>
                    <div class="content-bottom-mobile">
                        <div class="mobile-block">
                            @if ( $data['advertisings']->enable_banner_banner_left_and_right )
                                @if ($banners->banner_left != '')
                                    <div class="bnr">
                                        {!! $banners->banner_left ?? '' !!}
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="right-block">
                            @if ( $data['advertisings']->enable_banner_banner_left_and_right )
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


<footer class="footer-section">
    @include ('site.partials.footer')
</footer>


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
{!! $footer_script !!}
@yield('script')
</body>
</html>
