@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @include('components.info-bar')
    <hr class="layout__divider"/>
    <nav class="layout__breadcrumb"><a href="#">Главная</a> / Мои заказы</nav>
    @include('components.layout-head')
    <div class="profile">
        <div class="profile__side">
            <div class="profile__user">
                <img
                    src="{{ $profile->avatar ? 'data:image/png;base64,' . base64_encode($profile->avatar) : '/static/img/ava-placeholder.svg' }}"
                    width="44"
                    height="44"
                    class="profile__ava"
                    alt="Profile Avatar"
                    id="image-preview"
                />
                <input type="file" id="image-input" accept="image/*" style="display: none;"/>
                <button class="button button_tertiary button_md profile__upload-photo" id="upload-button">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M19 7v2.99h-2V7h-3V5h3V2h2v3h3v2h-3Zm-3 4V8h-3V5H5a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-8h-3ZM5 19l3-4 2 3 3-4 4 5H5Z"
                        ></path>
                    </svg
                    >
                    Загрузить фото
                </button>
                <div id="image-cropper-container" style="width: 217px; height: 217px; display: none;">
                    <img id="image-preview" alt="Image preview" style="display: none;">
                </div>
            </div>
        </div>
        <div class="profile__main">
            <form id="profileForm" class="profile__edit-form">
                <div class="profile__plate">
                    <h2 class="profile__title">Редактировать профиль</h2>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="field col-span-full">
                            <label class="label" for="input-fullname">ФИО:</label
                            ><input
                                class="input"
                                type="text"
                                id="input-fullname"
                                name="fullname"
                                placeholder="Введите данные..."
                                value="{{ $profile->name ?? ''}}"
                            />
                        </div>
                        <div class="field">
                            <label class="label" for="input-passport">Паспортные данные:</label
                            ><input class="input" type="text" id="input-passport" name="passport"
                                    value="{{ $profile->passport_data ?? '' }}"/>
                        </div>
                        <div class="field">
                            <label class="label" for="input-city">Город:</label
                            ><input class="input" type="text" id="input-city" name="city"
                                    value="{{ $profile->city ?? ''}}"/>
                        </div>
                        <div class="field">
                            <label class="label" for="input-email">Email:</label
                            ><input class="input" type="text" id="input-email" name="email"
                                    value="{{ $user->email ?? ''}}" readonly/>
                        </div>
                    </div>
                    <div class="mt-10">
                        <p class="profile__legend">Предпочитаемый вид связи:</p>
                        <div class="grid gap-2.5">
                            <!--
                            <div class="edit-item">
                                <label class="checkbox edit-item__checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" checked/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ></label>
                                <div class="edit-item__content">
                                    <div class="edit-item__content-inner">
                                        <div class="edit-item__social">
                                            <div class="social social_vk">
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="social__icon">
                                                    <path
                                                        d="M12.59 16.2c-4.51 0-7.08-3.15-7.19-8.4h2.26c.07 3.85 1.74 5.48 3.06 5.82V7.8h2.13v3.32c1.3-.14 2.67-1.66 3.13-3.32h2.13a6.47 6.47 0 0 1-2.9 4.19 6.54 6.54 0 0 1 3.39 4.21h-2.34A4.16 4.16 0 0 0 15 14.17a4.04 4.04 0 0 0-2.15-.97v3h-.26Z"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <span class="edit-item__social-value">id...</span>
                                        </div>
                                    </div>
                                    <div class="edit-controls edit-item__controls">
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"
                                                ></path>
                                            </svg>
                                        </button
                                        >
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="edit-item">
                                <label class="checkbox edit-item__checkbox" style=""
                                ><input class="checkbox__input" type="checkbox"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ></label>
                                <div class="edit-item__content">
                                    <div class="edit-item__content-inner">
                                        <div class="edit-item__social">
                                            <div class="social social_telegram">
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="social__icon">
                                                    <path
                                                        d="M16.8 7.56 15 16.98s-.26.65-.95.34l-4.16-3.3-.02-.02 5.11-4.76c.3-.29.11-.46-.23-.24l-6.44 4.23-2.48-.86s-.39-.15-.43-.46c-.04-.31.44-.48.44-.48L15.97 7.3s.83-.38.83.25Z"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <span class="edit-item__social-value">id...</span>
                                        </div>
                                    </div>
                                    <div class="edit-controls edit-item__controls">
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"
                                                ></path>
                                            </svg>
                                        </button
                                        >
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="edit-item">
                                <label class="checkbox edit-item__checkbox" style=""
                                ><input class="checkbox__input" type="checkbox"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ></label>
                                <div class="edit-item__content">
                                    <div class="edit-item__content-inner">
                                        <div class="edit-item__social">
                                            <div class="social social_viber">
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="social__icon">
                                                    <path
                                                        d="M15.75 5.73a18.59 18.59 0 0 0-6.95 0c-1 .22-2.28 1.44-2.5 2.4-.4 1.88-.4 3.8 0 5.68a4.12 4.12 0 0 0 2.5 2.4c.05 0 .1.04.1.09v2.75c0 .13.17.22.26.09l1.31-1.36s1.06-1.1 1.24-1.27c0 0 .04-.04.08-.04a20.6 20.6 0 0 0 4-.3c1.02-.22 2.3-1.45 2.51-2.4.4-1.88.4-3.8 0-5.68a4.13 4.13 0 0 0-2.55-2.36Zm.05 8.2c-.22.44-.49.8-.93 1.01l-.4.13a10.36 10.36 0 0 1-4.22-2.62 10.5 10.5 0 0 1-1.45-2.18c-.17-.4-.35-.74-.48-1.14-.13-.35.09-.7.3-.96.23-.26.5-.43.8-.56.22-.14.44-.05.62.13.35.43.7.87.96 1.35.18.3.13.66-.17.87-.1.05-.14.1-.22.18-.05.04-.14.09-.18.17a.42.42 0 0 0-.04.4c.35 1 1 1.79 2.02 2.22.18.1.3.13.53.13.3-.04.44-.39.66-.56.22-.18.48-.18.75-.05.21.13.43.3.7.48.22.18.44.3.66.48.13.1.17.31.09.53Zm-1.85-3.27c-.09 0-.04 0 0 0-.18 0-.22-.08-.26-.22 0-.08 0-.21-.05-.3a.83.83 0 0 0-.3-.48l-.27-.13c-.13-.05-.22-.05-.35-.05-.13-.04-.18-.13-.18-.26 0-.09.13-.17.22-.17.7.04 1.23.43 1.32 1.26v.18c0 .09-.04.17-.13.17Zm-.44-1.92a3.31 3.31 0 0 0-.7-.22c-.1 0-.22-.04-.31-.04-.13 0-.22-.09-.18-.22 0-.13.09-.22.22-.17.44.04.84.13 1.23.3.8.4 1.23 1.05 1.37 1.92v.57c-.05.18-.36.22-.4 0l-.04-.17c0-.4-.1-.79-.27-1.14-.26-.4-.57-.65-.92-.83Zm2.37 2.62c-.13 0-.22-.13-.22-.26 0-.26-.04-.52-.08-.79a3.26 3.26 0 0 0-2.69-2.75c-.22-.04-.44-.04-.61-.09-.13 0-.31 0-.35-.17-.05-.13.08-.26.22-.26h.08c.1 0 1.8.04 0 0a3.73 3.73 0 0 1 3.7 3.1c.04.3.09.61.09.96.08.13 0 .26-.14.26Z"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <span class="edit-item__social-value">id...</span>
                                        </div>
                                    </div>
                                    <div class="edit-controls edit-item__controls">
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"
                                                ></path>
                                            </svg>
                                        </button
                                        >
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="edit-item">
                                <label class="checkbox edit-item__checkbox" style=""
                                ><input class="checkbox__input" type="checkbox"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ></label>
                                <div class="edit-item__content">
                                    <div class="edit-item__content-inner">
                                        <div class="edit-item__social">
                                            <div class="social social_whatsapp">
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="social__icon">
                                                    <path
                                                        d="M16.76 7.24a6.27 6.27 0 0 0-9.88 7.52L6 18l3.34-.88a6.27 6.27 0 0 0 9.26-5.51 6.38 6.38 0 0 0-1.84-4.37Zm-1.4 6.65c-.14.35-.76.7-1.06.74a2.7 2.7 0 0 1-.97-.04c-.22-.09-.53-.18-.88-.35a6.47 6.47 0 0 1-2.67-2.37 2.82 2.82 0 0 1-.66-1.61c0-.8.4-1.14.52-1.32.14-.17.31-.17.44-.17h.31c.09 0 .22-.04.35.26.13.3.44 1.1.48 1.14.05.09.05.17 0 .26a.91.91 0 0 1-.17.26l-.22.27c-.09.08-.18.17-.09.3.09.18.4.66.88 1.1.61.52 1.1.7 1.27.78.18.1.27.05.35-.04.1-.09.4-.44.49-.61.08-.18.22-.13.35-.09a11.8 11.8 0 0 1 1.36.7c.04.13.04.44-.09.79Z"
                                                    ></path>
                                                </svg>
                                            </div>
                                            <span class="edit-item__social-value"><input type="text"/></span>
                                        </div>
                                    </div>
                                    <div class="edit-controls edit-item__controls">
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"
                                                ></path>
                                            </svg>
                                        </button
                                        >
                                        <button type="button" class="edit-controls__button">
                                            <svg
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                                class="edit-controls__icon"
                                            >
                                                <path
                                                    d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                    <div class="mt-10">
                        <p class="profile__legend">Телефон:</p>
                        <div class="grid gap-2.5">
                            @foreach ($profile->phones as $phone)
                                <div class="edit-item">
                                    <label class="checkbox edit-item__checkbox">
                                        <input class="checkbox__input"
                                               type="checkbox" {{ $phone->is_active ? 'checked' : '' }} />
                                        <span class="checkbox__control" aria-hidden="true">
                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"></path>
                </svg>
            </span>
                                    </label>
                                    <div class="edit-item__content">
                                        <div class="edit-item__content-inner">
                                            <div class="edit-item__value">
                                                <input type="text" value="{{ $phone->number }}" readonly>
                                            </div>
                                        </div>
                                        <div class="edit-controls edit-item__controls">
                                            <button type="button" class="edit-controls__button"
                                                    phone_id="{{ $phone->id }}" onclick="editPhone(this)">
                                                <svg viewBox="0 0 20 20" fill="currentColor"
                                                     class="edit-controls__icon">
                                                    <path
                                                        d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="edit-controls__button"
                                                    phone_id="{{ $phone->id }}" onclick="deletePhone(this)">
                                                <svg viewBox="0 0 20 20" fill="currentColor"
                                                     class="edit-controls__icon">
                                                    <path
                                                        d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="edit-item phone-form" style="display: none;">
                                <label class="checkbox edit-item__checkbox" style=""
                                ><input class="checkbox__input" name="is_active" type="checkbox" checked/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ></label>
                                <div class="edit-item__content">
                                    <div class="edit-item__content-inner">
                                        <div class="edit-item__value"><input type="text" name="phone"
                                                                             placeholder="Введите Номер"/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 grid gap-5 sm:grid-cols-2 phone-form" style="display: none;">
                            <button class="button button_primary button_md" type="button" onclick="addPhone()">
                                Добавить номер
                            </button
                            >
                            <button class="button button_secondary button_md" type="button" onclick="hidePhoneForm()">
                                Отменить
                            </button>
                        </div>
                        <div class="mt-5 grid gap-5 sm:grid-cols-2">
                            <button
                                class="button button_quaternary button_md add-button sm:col-start-2"
                                type="button"
                                onclick="showPhoneForm()"
                            >
                                <svg viewBox="0 0 24 24" fill="currentColor" class="add-button__icon">
                                    <path
                                        d="M12 22A10 10 0 0 1 2 12v-.2A10 10 0 1 1 12 22ZM7 11v2h4v4h2v-4h4v-2h-4V7h-2v4H7Z"
                                    ></path>
                                </svg
                                >
                                Добавить телефон
                            </button>
                        </div>
                    </div>
                    <div class="mt-10">
                        <p class="profile__legend">Адреса доставки:</p>
                        <div class="grid gap-2.5">
                            @foreach($profile->addresses as $address)
                                <div class="edit-item">
                                    <label class="checkbox edit-item__checkbox" style=""
                                    ><input class="checkbox__input" type="checkbox" checked/><span
                                            class="checkbox__control"
                                            aria-hidden="true"
                                        ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                        ></label>
                                    <div class="edit-item__content">
                                        <div class="edit-item__content-inner">
                                            <div class="edit-item__value">{{ $address->formatted_address }}</div>
                                        </div>
                                        <div class="edit-controls edit-item__controls">
                                            <button type="button" class="edit-controls__button"
                                                    onclick="editAddress({{$address->id}})">
                                                <svg
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="edit-controls__icon"
                                                >
                                                    <path
                                                        d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"
                                                    ></path>
                                                </svg>
                                            </button
                                            >
                                            <button type="button" class="edit-controls__button"
                                                    onclick="deleteAddress({{$address->id}})">
                                                <svg
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                    class="edit-controls__icon"
                                                >
                                                    <path
                                                        d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-5 grid gap-5 sm:grid-cols-2 address-form" style="display: none">
                            <div class="field col-span-full">
                                <label class="label" for="input-delivery-country">Страна:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-delivery-country"
                                    name="delivery-country"
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-delivery-city">Город:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-delivery-city"
                                    name="delivery-city"
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-delivery-street">Улица:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-delivery-street"
                                    name="delivery-street"
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-delivery-building">Корпус:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-delivery-building"
                                    name="delivery-building"
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-delivery-appartment">Квартира, дом:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-delivery-appartment"
                                    name="delivery-appartment"
                                />
                            </div>
                        </div>
                        <div class="mt-5 grid gap-5 sm:grid-cols-2 address-form" style="display: none">
                            <button class="button button_primary button_md" type="button" onclick="addAddress()">
                                Добавить адрес
                            </button
                            >
                            <button class="button button_primary button_md" type="button" onclick="updateAddress()"
                                    style="display: none">
                                Сохранить
                            </button
                            >
                            <button class="button button_secondary button_md" type="button" onclick="hideAddressForm()">
                                Отменить
                            </button>
                        </div>
                        <div class="mt-5 grid gap-5 sm:grid-cols-2">
                            <button
                                class="button button_quaternary button_md add-button sm:col-start-2"
                                type="button"
                                onclick="showAddressForm()"
                            >
                                <svg viewBox="0 0 24 24" fill="currentColor" class="add-button__icon">
                                    <path
                                        d="M12 22A10 10 0 0 1 2 12v-.2A10 10 0 1 1 12 22ZM7 11v2h4v4h2v-4h4v-2h-4V7h-2v4H7Z"
                                    ></path>
                                </svg
                                >
                                Добавить адрес
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <button class="button button_primary button_md" type="submit">Сохранить
                    </button
                    >
                    <button class="button button_secondary button_md" type="button">
                        Отменить
                    </button>
                </div>
            </form>
        </div>
    </div>
    @if(session('success'))
        <script>
            window.onload = () => {
                showSuccessAlert('{{ session('success') }}');
            };
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
            editPassword.showModal();
            @endif
        });
    </script>
@endsection
@section('styles')
    <style>
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
            overflow: hidden;
        }
    </style>
@endsection
@section('scripts')
    <script>
        let currentAddressId = null;

        function showPhoneForm() {
            document.querySelectorAll('.phone-form').forEach(function (form) {
                form.style.display = 'flex';
            });
        }

        function hidePhoneForm() {
            document.querySelectorAll('.phone-form').forEach(function (form) {
                form.style.display = 'none';
            });
        }

        function showAddressForm() {
            document.querySelectorAll('.address-form').forEach(function (form) {
                form.style.display = 'grid';
            });
        }

        function hideAddressForm() {
            $('.address-form').hide();
            $('button[onclick="addAddress()"]').show();
            $('button[onclick="updateAddress()"]').hide();
            currentAddressId = null;

            $('#input-delivery-country').val('');
            $('#input-delivery-city').val('');
            $('#input-delivery-street').val('');
            $('#input-delivery-building').val('');
            $('#input-delivery-appartment').val('');
        }


        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('profileForm').addEventListener('submit', function (event) {
                event.preventDefault();
                saveProfile();
            });
        });


        function saveProfile() {
            let fullname = document.querySelector('#input-fullname').value;
            let passport = document.querySelector('#input-passport').value;
            let city = document.querySelector('#input-city').value;
            let email = document.querySelector('#input-email').value;

            $.ajax({
                url: '{{ route("user.profileUpdate") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    fullname: fullname,
                    passport: passport,
                    city: city,
                    email: email
                },
                success: function(response) {
                    showSuccessAlert('Профиль успешно обновлен.');
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessages = [];
                        Object.values(xhr.responseJSON.errors).forEach((messages) => {
                            errorMessages.push(...messages);
                        });

                        showErrorAlert(errorMessages.join('\n'));
                    } else {
                        console.error('Error:', error);
                        showErrorAlert(error);
                    }
                }
            });
        }


        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image-input');
            const uploadButton = document.getElementById('upload-button');
            const imagePreview = document.getElementById('image-preview');
            const container = document.getElementById('image-cropper-container');
            let cropper;

            uploadButton.addEventListener('click', () => {
                if (input.files && input.files[0]) {
                    console.log('Image is ready to be uploaded...');
                } else {
                    input.click();
                }
            });

            input.addEventListener('change', (e) => {
                const files = e.target.files;
                if (files && files.length > 0) {
                    const file = files[0];
                    imagePreview.src = URL.createObjectURL(file);
                    imagePreview.style.display = 'block';
                    container.style.display = 'block';

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(imagePreview, {
                        aspectRatio: 1,
                        viewMode: 1,
                        circle: true,
                        ready: function () {
                            const cropperCanvas = this.cropper.getCroppedCanvas();
                            cropperCanvas.style.borderRadius = '50%';
                            cropperCanvas.style.overflow = 'hidden';
                        }
                    });

                    uploadButton.style.backgroundColor = 'lightblue';
                }
            });

            document.getElementById('upload-button').addEventListener('click', () => {
                if (cropper) {
                    cropper.getCroppedCanvas().toBlob((blob) => {
                        const formData = new FormData();
                        formData.append('avatar', blob);

                        $.ajax({
                            url: '{{route('user.avatarUpdate')}}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.success && data.message) {
                                    showSuccessAlert(data.message);
                                    $('#image-preview').attr('src', data.image);
                                } else {
                                    showErrorAlert('Image updated successfully, but no message was returned from the server.');
                                    $('#image-preview').attr('src', 'static/img/ava-placeholder.svg');
                                }

                                $('#image-input').val('');
                                cropper.destroy();
                                cropper = null;
                                $('#upload-button').css('background-color', '#ffffff');
                            },
                            error: function (xhr, status, error) {
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    let errorMessages = [];
                                    Object.values(xhr.responseJSON.errors).forEach((messages) => {
                                        errorMessages.push(...messages);
                                    });

                                    showErrorAlert(errorMessages.join('\n'));
                                } else {
                                    console.error('Error:', error);
                                    showErrorAlert(error);
                                }

                                $('#image-input').val('');
                                $('#image-preview').attr('src', 'static/img/ava-placeholder.svg');
                                cropper.destroy();
                                cropper = null;
                                $('#upload-button').css('background-color', '#ffffff');
                            }
                        });
                    });
                }

            });
        });

        function addPhone() {
            let phoneInput = document.querySelector('input[name="phone"]');
            let phoneValue = phoneInput.value;
            let isActiveCheckbox = document.querySelector('input[name="is_active"]');
            let isActive = isActiveCheckbox ? isActiveCheckbox.checked : false;

            $.ajax({
                url: '{{ route("user.addPhone") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    phone: phoneValue,
                    is_active: isActive
                },
                success: function (data) {
                    if (data.success) {
                        showSuccessAlert(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    } else {
                        showErrorAlert(data.error);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessages = [];
                        Object.values(xhr.responseJSON.errors).forEach((messages) => {
                            errorMessages.push(...messages);
                        });

                        showErrorAlert(errorMessages.join('\n'));
                    } else {
                        console.error('Error:', error);
                        showErrorAlert(error);
                    }
                }
            });
        }


        function addAddress() {
            let data = {
                'delivery-country': $('#input-delivery-country').val(),
                'delivery-city': $('#input-delivery-city').val(),
                'delivery-street': $('#input-delivery-street').val(),
                'delivery-building': $('#input-delivery-building').val(),
                'delivery-apartment': $('#input-delivery-appartment').val(),
            };

            $.ajax({
                url: '{{ route("user.addAddress") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: data,
                success: function (response) {
                    if (response.success) {
                        showSuccessAlert(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    } else {
                        showErrorAlert(response.error);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessages = [];
                        Object.values(xhr.responseJSON.errors).forEach((messages) => {
                            errorMessages.push(...messages);
                        });

                        showErrorAlert(errorMessages.join('\n'));
                    } else {
                        console.error('Error:', error);
                        showErrorAlert(error);
                    }
                }
            });
        }

        function editPhone(button) {
            let phoneId = button.getAttribute('phone_id');
            let phoneValue = prompt('Введите новый номер телефона');

            $.ajax({
                url: `{{ route('user.editPhone', ['phoneId' => 'phoneId']) }}`.replace('phoneId', phoneId),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    phone: phoneValue,
                    is_active: true
                },
                success: function (response) {
                    if (response.success) {
                        showSuccessAlert(response.message);
                        // location.reload();
                    } else {
                        showErrorAlert(response.error);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessages = [];
                        Object.values(xhr.responseJSON.errors).forEach((messages) => {
                            errorMessages.push(...messages);
                        });

                        showErrorAlert(errorMessages.join('\n'));
                    } else {
                        console.error('Error:', error);
                        showErrorAlert(error);
                    }
                }
            });
        }

        function deletePhone(button) {
            let phoneId = button.getAttribute('phone_id');

            if (confirm('Вы уверены, что хотите удалить этот телефонный номер?')) {
                $.ajax({
                    url: `{{ route('user.deletePhone', ['phoneId' => 'phoneId']) }}`.replace('phoneId', phoneId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            showSuccessAlert(response.message);
                            location.reload();
                        } else {
                            showErrorAlert(response.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errorMessages = [];
                            Object.values(xhr.responseJSON.errors).forEach((messages) => {
                                errorMessages.push(...messages);
                            });

                            showErrorAlert(errorMessages.join('\n'));
                        } else {
                            console.error('Error:', error);
                            showErrorAlert(error);
                        }
                    }
                });
            }
        }

        function editAddress(addressId) {
            currentAddressId = addressId;

            $.ajax({
                url: `/profile/address/${addressId}/edit`,
                type: 'GET',
                success: function (data) {
                    $('#input-delivery-country').val(data.country);
                    $('#input-delivery-city').val(data.city);
                    $('#input-delivery-street').val(data.street);
                    $('#input-delivery-building').val(data.building);
                    $('#input-delivery-appartment').val(data.apartment);

                    $('.address-form').show();
                    $('button[onclick="addAddress()"]').hide();
                    $('button[onclick="updateAddress()"]').show();
                },
                error: function (xhr, status, error) {
                    console.error('Ошибка при получении данных адреса: ' + error);
                }
            });
        }

        function updateAddress() {
            let addressId = currentAddressId;
            let data = {
                'delivery-country': $('#input-delivery-country').val(),
                'delivery-city': $('#input-delivery-city').val(),
                'delivery-street': $('#input-delivery-street').val(),
                'delivery-building': $('#input-delivery-building').val(),
                'delivery-apartment': $('#input-delivery-appartment').val(),
            };

            $.ajax({
                url: `/profile/address/${addressId}/update`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function (response) {
                    if (response.success) {
                        showSuccessAlert(response.message);
                        $('.address-form').hide();
                        $('button[onclick="addAddress()"]').show();
                        $('button[onclick="updateAddress()"]').hide();
                        currentAddressId = null;
                        location.reload();
                    } else {
                        showErrorAlert(response.error);
                    }
                },
                error: function (xhr, status, error) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errorMessages = [];
                        Object.values(xhr.responseJSON.errors).forEach((messages) => {
                            errorMessages.push(...messages);
                        });

                        showErrorAlert(errorMessages.join('\n'));
                    } else {
                        console.error('Error:', error);
                        showErrorAlert(error);
                    }
                }
            });
        }


        function deleteAddress(addressId) {
            if (confirm('Вы уверены, что хотите удалить этот адрес?')) {
                $.ajax({
                    url: `/profile/address/${addressId}/delete`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            showSuccessAlert(response.message);
                            location.reload();
                        } else {
                            showErrorAlert(response.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errorMessages = [];
                            Object.values(xhr.responseJSON.errors).forEach((messages) => {
                                errorMessages.push(...messages);
                            });

                            showErrorAlert(errorMessages.join('\n'));
                        } else {
                            console.error('Error:', error);
                            showErrorAlert(error);
                        }
                    }
                });
            }
        }


        // const image = document.getElementById('image-preview');
        // const input = document.getElementById('image-input');
        // let cropper;

        // input.addEventListener('change', (e) => {
        //     const files = e.target.files;
        //     if (files && files.length > 0) {
        //         const file = files[0];
        //         image.src = URL.createObjectURL(file);
        //
        //         cropper ? cropper.destroy() : null;
        //         cropper = new Cropper(image, {
        //             aspectRatio: 1, // adjust as needed
        //             viewMode: 1, // restrict the crop box to not exceed the size of the canvas
        //         });
        //     }
        // });
    </script>
@endsection
