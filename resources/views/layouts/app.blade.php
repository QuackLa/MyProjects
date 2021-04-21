<!doctype html>
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('../resources/js/app.js') }}" defer></script>
    <script src="{{ asset('../resources/js/check.js') }}"></script>
    <script src="{{ asset('../resources/js/progressBar.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<!-- Меню -->
<header>
    @if(auth()->check())
        @include('menu')
    @endif
</header>

<body>

    <!-- Основной контент -->
    <div class="container">
        @include('messagesAndErrors')
        @yield('content')
    </div>

</body>
</html>