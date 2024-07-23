<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add CSS and other meta tags here -->
</head>
<body>
    <div id="app">
        <nav>
            <!-- Navigation links here -->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
