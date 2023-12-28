@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ __('messages.breadcrumbs.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.profile') }}</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('messages.my_data') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('messages.name_label') }}</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('messages.name') }}" value="{{ $profile->name ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __('messages.phone_label') }}</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('messages.phone') }}" value="{{ $profile->phone ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="telegram">{{ __('messages.telegram_chat_id_label') }}</label>
                                <input type="text" class="form-control" name="telegram_chat_id" id="telegram" placeholder="{{ __('messages.telegram_chat_id') }}" value="{{ $profile->telegram_chat_id ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="city">{{ __('messages.city_label') }}</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="{{ __('messages.city') }}" value="{{ $profile->city ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{ __('messages.address_label') }}</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="{{ __('messages.address') }}" value="{{ $profile->address ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="passport">{{ __('messages.passport_data_label') }}</label>
                                <input type="text" class="form-control" name="passport_data" id="passport" placeholder="{{ __('messages.passport_data') }}" value="{{ $profile->passport_data ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="email" placeholder={{ __('messages.email') }}" value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="form-group password-field" style="display: none;">
                                <label for="new_password">{{ __('messages.new_password_label') }}</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="{{ __('messages.new_password') }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" id="changePasswordButton">{{ __('messages.change_password') }}</button>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary">{{ __('messages.cancel') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <script>
            window.onload = () => {
                showSuccessAlert('{{ session('success') }}');
            };
        </script>
    @endif
@endsection

@section('scripts')
    <script>
        document.getElementById('changePasswordButton').addEventListener('click', function() {
            let passwordFields = document.querySelectorAll('.password-field');
            passwordFields.forEach(function(field) {
                field.style.display = field.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
@endsection

