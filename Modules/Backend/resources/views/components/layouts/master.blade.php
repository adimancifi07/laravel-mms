<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Backend Module -{!! config('backend.name') !!} {{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="{{ $description ?? '' }}">
        <meta name="keywords" content="{{ $keywords ?? '' }}">
        <meta name="author" content="{{ $author ?? '' }}">
        {{-- @vite(['Modules/Backend/resources/assets/css/style.css']) --}}
        {{-- Vite CSS --}}
        {{ module_vite('build-backend', 'resources/assets/css/style.css', storage_path('vite-backend.hot')) }}
        {{ module_vite('build-backend', 'resources/assets/js/app.js', storage_path('vite-backend.hot')) }}
    </head>

    <body>
        {{ $slot }}

        {{-- Vite JS --}}
        {{-- {{ module_vite('build-modules', 'Modules/Backend/resources/assets/js/app.js') }} --}}
    </body>
</html>
