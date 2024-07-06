<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="bumblebee">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--    Either $title .. " - Blog example", or just "Blog example" --}}
    <title>{{ $title ? $title.' - ' : '' }}Blog example</title>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col">
<x-navigation/>

@if (session()->has('global-message'))
    <div
        role="alert"
        class="{{ session()->has('global-message-status') && session('global-message-status') === 'error' ? 'alert-error' : 'alert-success' }} alert text-white max-w-xs w-full mx-auto">
        @if (session()->has('global-message-status') && session('global-message-status') === 'error')
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @else
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @endif
        <span>{{ session('global-message') }}</span>
    </div>
@endif

<main class="container mx-auto flex flex-col my-8">
    {{ $slot }}
</main>

@vite('resources/js/app.js')
</body>
</html>
