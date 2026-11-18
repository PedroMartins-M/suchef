<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SuChef')</title>

    @vite([
        
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body>

    @yield('content')

</body>
</html>