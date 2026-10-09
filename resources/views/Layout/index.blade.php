<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'CRM Dashboard')</title>

    @vite([
        'resources/css/app.css',
        'resources/css/layout.css',
        'resources/css/form.css',
        'resources/js/app.js',
        'resources/js/datatable.js'
    ])
    @stack('styles')
</head>
<body>

    @include('layout.sidebar')

    <main class="main-content">
        @yield('content')
    </main>

    @stack('scripts')

</body>
</html>
