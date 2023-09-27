<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

    </head>
    <body>
        <h1>This is a Heading</h1>
        <p>This is a paragraph of text.</p>
        <a href="#">This is a link</a>
        <button class="button">Click me</button>
        <div class="box">This is a box</div>
    </body>
</html>
