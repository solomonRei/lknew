<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ainatao</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">{{ __('messages.breadcrumbs.home') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{ __('messages.language') }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                <li><a class="dropdown-item" href="{{ url('language/en') }}">English</a></li>
                <li><a class="dropdown-item" href="{{ url('language/ru') }}">Русский</a></li>
            </ul>
        </div>

        @if(\Auth::check())
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-warning">{{ __('messages.auth.logout') }}</button>
            </form>
        @endif
    </nav>
</div>
