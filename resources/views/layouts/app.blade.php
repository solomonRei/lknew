<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Site title')</title>
    <meta name="description" content="@yield('description', 'Site description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('static/css/app.css') }}" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="module" crossorigin src="{{ asset('static/js/app.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
    @yield('styles')
</head>
<body>
<div
    data-alert-error="{{ __('messages.alert.error') }}"
    data-alert-success="{{ __('messages.alert.success') }}"
    data-alert-ok="{{ __('messages.alert.ok') }}"
    id="alertTranslations" style="display: none;">
</div>
<div class="app">
    <div class="layout">
        <div class="layout__container container">
            @include('components.sidebar')
            <div class="layout__main">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
@yield('scripts')
</html>
