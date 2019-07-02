<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('include.head')
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>Vali</h1>
        </div>

        @yield('content')
    </section>

@include('include.javascript')
</body>
</html>