<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="http://ufrhub.loc/dashboard/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=2" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="content align-middle">


    <section class="footer-top-section align-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if ( \Route::currentRouteName() == 'home')
                        <div class="logo-text">
                            <img src="/img/logo.png" alt="">
                        </div>
                    @elseif ( \Route::currentRouteName() == 'upload-file.show')
                        <div class="info-box single-info-box">
                            <div class="col-md-12">
                                <div class="code">
                                    @yield('code')
                                </div>

                                <div class="message" style="padding: 10px;">
                                    Error @yield('message')
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="info-box">
                            <h1>@yield('title')</h1>
                            @yield('content')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .card {
        border: 0;
    }
    .card-header {
        border-bottom: 0;
    }
    .content {
        display: flex;
    }
    .footer-top-section {
        width: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
    }
    .info-box {
        width: 100%;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
