<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('include.head')
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="app sidebar-mini rtl">
    @include('include.header')
    @include('include.sidebar')
    <main class="main app-content">
        @yield('content')
    </main>
    @include('include.javascript')
</body>
</html>
