    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')"/>
    <meta name="category" content="@yield('category')"/>

    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:alt" content="@yield('title')" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />

    <meta property="twitter:card" content="@yield('description')" />
    <meta property="twitter:title" content="@yield('title')" />
    <meta property="twitter:description" content="@yield('description')" />
    <meta property="twitter:domain" content="{{ request()->getHost() }}" />
    <meta property="twitter:image:src" content="@yield('image')" />
