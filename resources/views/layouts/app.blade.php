<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Medisains') }}</title>
    <!-- Add CSS and other meta tags here -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="dark:bg-gray-900">
    <div id="app">
        <nav>
            <!-- Navigation links here -->
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const togglePassword1 = document.querySelector('#togglePassword1');
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password = document.querySelector('#password');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePassword1 && togglePassword1.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon1.classList.toggle('fa-eye');
            eyeIcon1.classList.toggle('fa-eye-slash');
        });
        togglePassword2 && togglePassword2.addEventListener('click', function(e) {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            eyeIcon2.classList.toggle('fa-eye');
            eyeIcon2.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
