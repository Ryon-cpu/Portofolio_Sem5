<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fiqtoril Oyun – Web Developer</title>
    <meta name="description"
        content="Portofolio Fiqtoril Oyun – Web Developer yang berfokus membangun pengalaman digital yang bersih, fungsional, dan berkesan.">

    @fonts
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app"></div>
</body>

</html>
