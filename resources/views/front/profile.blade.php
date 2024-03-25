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
                    src="{{ $profile->avatar ? 'data:image/png;base64,' . base64_encode($profile->avatar) : 'static/img/ava-placeholder.svg' }}"
                    width="44"
                    height="44"
                    class="profile__ava"
                    alt="Profile Avatar"
                    id="image-preview"
                />
                <input type="file" id="image-input" accept="image/*" style="display: none;"/>
                <button class="button button_tertiary button_md profile__upload-photo" id="upload-button"><svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M19 7v2.99h-2V7h-3V5h3V2h2v3h3v2h-3Zm-3 4V8h-3V5H5a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-8h-3ZM5 19l3-4 2 3 3-4 4 5H5Z"
                        ></path></svg
                    >
                    Загрузить фото
                </button>
                <div id="image-cropper-container" style="width: 217px; height: 217px; display: none;">
                    <img id="image-preview" alt="Image preview" style="display: none;">
                </div>
            </div>
        </div>
        <div class="profile__main">
            <div class="profile__plate">
                <div class="profile__specs">
                    <div class="profile__spec">
                        <div class="profile__term">ФИО:</div>
                        <div class="profile__def">{{ $profile->name ?? '' }}</div>
                    </div>
                    <div class="profile__spec">
                        <div class="profile__term">Телефон:</div>
                        <div class="profile__def">
                                {{ $profile->phones->first()->number ?? '' }}
                            </div>
                    </div>
                    <div class="profile__spec">
                        <div class="profile__term">Паспортные данные:</div>
                        <div class="profile__def">{{ $profile->passport_data ?? '' }}</div>
                    </div>
                    <div class="profile__spec">
                        <div class="profile__term">Email:</div>
                        <div class="profile__def">{{ $user->email ?? ''}}</div>
                    </div>
                    <div class="profile__spec">
                        <div class="profile__term">Город:</div>
                        <div class="profile__def">{{ $profile->city ?? ''}}</div>
                    </div>
                    <div class="profile__spec">
                        <div class="profile__term">Адреса доставки:</div>
                        <div class="profile__def">
                                {{ $profile->addresses->first()->formatted_address ?? '' }}
                            </div>
                    </div>
                    <div class="profile__spec">
                        <div class="profile__term">Предпочитаемый вид связи:</div>
                        <div class="profile__def">
                            <div class="profile__socials">
                                <div class="social social_vk">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="social__icon">
                                        <path
                                            d="M12.59 16.2c-4.51 0-7.08-3.15-7.19-8.4h2.26c.07 3.85 1.74 5.48 3.06 5.82V7.8h2.13v3.32c1.3-.14 2.67-1.66 3.13-3.32h2.13a6.47 6.47 0 0 1-2.9 4.19 6.54 6.54 0 0 1 3.39 4.21h-2.34A4.16 4.16 0 0 0 15 14.17a4.04 4.04 0 0 0-2.15-.97v3h-.26Z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile__form">
                    <div class="field">
                        <label class="label">Пароль:</label
                        ><input
                            class="input"
                            type="password"
                            name="password"
                            value="password"
                            readonly="true"
                            inert="true"
                        />
                    </div>
                    <button
                        class="button button_secondary button_md self-end"
                        onclick="editPassword.showModal()"
                        type="submit"
                    >
                        Изменить пароль
                    </button>
                    <dialog class="dialog" id="editPassword">
                        <form method="dialog">
                            <button class="dialog__close">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M15.59 7 12 10.59 8.41 7 7 8.41 10.59 12 7 15.59 8.41 17 12 13.41 15.59 17 17 15.59 13.41 12 17 8.41 15.59 7Z"
                                    ></path>
                                </svg>
                            </button>
                        </form>
                        <div class="dialog__inner">
                            <h3 class="dialog__title">Изменить пароль</h3>
                            <form action="{{ route("user.changePassword") }}" class="edit-password" method="POST">
                                @csrf
                                <div class="edit-password__fields">
                                    <div class="edit-password__field-row">
                                        <div class="field">
                                            <label class="label" for="input-password"
                                            >Введите старый пароль</label
                                            ><input
                                                class="input @error('password') is-invalid @enderror"
                                                type="password"
                                                id="input-password"
                                                name="password"
                                                required
                                            />
                                        </div>
                                        @error('password')
                                        <p class="edit-password__error">{{ $message }}</p>
                                        @enderror

                                    </div>
                                    <div class="edit-password__field-row">
                                        <div class="field">
                                            <label class="label" for="input-new-password"
                                            >Введите введите новый пароль</label
                                            ><input
                                                class="input @error('new-password') is-invalid @enderror"
                                                type="password"
                                                id="input-new-password"
                                                name="new-password"
                                                required
                                            />
                                        </div>
                                        @error('new-password')
                                        <p class="edit-password__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="edit-password__field-row">
                                        <div class="field">
                                            <label class="label" for="input-confirm-password"
                                            >Повторите новый пароль</label
                                            ><input
                                                class="input"
                                                type="password"
                                                id="input-confirm-password"
                                                name="new-password_confirmation"
                                                required
                                            />
                                        </div>
                                        @error('new-password_confirmation')
                                        <p class="edit-password__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="edit-password__forgot">
                                    Забыли пароль? <a href="#">Нажмите</a>
                                </div>
                                <div class="edit-password__footer">
                                    <button class="button button_primary button_md" type="submit">
                                        Изменить пароль
                                    </button
                                    >
                                    <button
                                        class="button button_secondary button_md"
                                        attr:onclick="this.closest('dialog').close()"
                                        type="reset"
                                    >
                                        Отменить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </dialog>
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
