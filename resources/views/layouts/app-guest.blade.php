<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
</head>
<body>
<div
    data-alert-error="{{ __('messages.alert.error') }}"
    data-alert-success="{{ __('messages.alert.success') }}"
    data-alert-ok="{{ __('messages.alert.ok') }}"
    id="alertTranslations" style="display: none;">
</div>
@include('components.header')
<main class="py-4">
    @yield('content')
</main>
{{--@include('components.footer')--}}
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</html>
