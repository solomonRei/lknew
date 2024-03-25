@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="info-bar">
        <div class="info-bar__item">
            <div class="info-bar__item-main">
                Баланс по заказам<span class="info-bar__item-value">{{ $userProfile->balance }} ¥</span>
            </div>
        </div>
        <div class="info-bar__item">
            <div class="info-bar__item-main">
                Курс ¥<span class="info-bar__item-value">13.10 ₽</span>
            </div>
            <div class="info-bar__item-side">
                15.01.2024
                <button class="info-bar__item-refresh" type="button">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="info-bar__item-icon">
                        <path
                            d="m19 8-4 4h3a6 6 0 0 1-8.8 5.3l-1.46 1.46A8 8 0 0 0 20 12h3l-4-4ZM6 12a6 6 0 0 1 8.8-5.3l1.46-1.46A8 8 0 0 0 4 12H1l4 4 4-4H6Z"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="info-bar__search">
            <form class="search">
                <input
                    class="search__input"
                    type="text"
                    required
                    placeholder="Название заказа, № заказа или позиции"
                />
                <div class="search__addon">
                    <svg viewBox="0 0 24 24" fill="none" class="search__icon">
                        <g clip-path="url(#search_svg__a)">
                            <path
                                d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 1 0-.7.7l.27.28v.79l5 4.99L20.49 19l-4.99-5Zm-6 0a4.5 4.5 0 1 1-.01-8.99A4.5 4.5 0 0 1 9.5 14Z"
                                fill="#989898"
                            ></path>
                        </g>
                        <defs>
                            <clipPath id="search_svg__a">
                                <path fill="#fff" d="M0 0h24v24H0z"></path>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </form>
            <label class="hamburger"
            ><span class="hamburger__bar"></span><span class="hamburger__bar"></span
                ><span class="hamburger__bar"></span
                ><input type="checkbox" id="sidebar-toggle" class="sr-only"
                /></label>
        </div>
    </div>
    <hr class="layout__divider"/>
    <nav class="layout__breadcrumb"><a href="#">Главная</a> / Создать заказ</nav>
    <div class="layout__head"><h1 class="layout__title">Создать заказ</h1></div>
    <div class="create-order">
        <div class="create-order__content">
            <div class="create-order__add-wrap">
                <button
                    class="button button_tertiary button_md add-button w-full"
                    onclick="createProduct.showModal()"
                    type="button"
                >
                    <svg viewBox="0 0 24 24" fill="currentColor" class="add-button__icon">
                        <path
                            d="M12 22A10 10 0 0 1 2 12v-.2A10 10 0 1 1 12 22ZM7 11v2h4v4h2v-4h4v-2h-4V7h-2v4H7Z"
                        ></path>
                    </svg
                    >
                    Создать позицию
                </button>
                <dialog class="dialog" id="createProduct">
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
                        <h3 class="dialog__title">Создать позицию</h3>
                        <form class="create-product">
                            <div class="mb-10 grid gap-5 sm:grid-cols-4">
                                <div class="field col-span-full">
                                    <label class="label" for="input-link">Ссылка</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="input-link"
                                        name="link"
                                        placeholder="Вставьте ссылку на товар..."
                                        required
                                    />
                                </div>
                                <div class="field sm:col-span-2">
                                    <label class="label" for="input-name">Название позиции</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="input-name"
                                        name="name"
                                        required
                                    />
                                </div>
                                <div class="field">
                                    <label class="label" for="input-price">Цена ¥</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="input-price"
                                        name="price"
                                        required
                                    />
                                </div>
                                <div class="field">
                                    <label class="label" for="input-quantity">Количество</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="input-quantity"
                                        name="quantity"
                                        required
                                    />
                                </div>
                            </div>
                            <h4 class="create-product__subtitle">Дополнительные услуги:</h4>
                            <div class="mb-5 grid gap-5 sm:grid-cols-2">
                                <label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" name="is_photo_report"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label">Заказать фото отчет</span></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" name="is_lathing"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label">Добавить обрешетку</span></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" name="is_measure"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label">Заказать замер</span></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" name="is_bubble_wrap"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label"
                                    >Упаковка в пузырчатую пленку</span
                                    ></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" name="is_comment"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label"
                                    >Добавить другие услуги в комментарии</span
                                    ></label
                                >
                            </div>
                            <div class="mb-10">
                          <textarea
                              class="input"
                              id="input-quantity"
                              name="comment"
                              rows="5"
                              placeholder="Напишите ваш комментарий по заказу..."
                          ></textarea>
                            </div>
                            <h4 class="create-product__subtitle">Добавить изображение</h4>
                            <div class="upload-file">
                                <div class="upload-file__drop" id="drop-zone">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="upload-file__drop-icon">
                                        <path
                                            d="M21 3H3C2 3 1 4 1 5v14c0 1.1.9 2 2 2h18c1 0 2-1 2-2V5c0-1-1-2-2-2ZM5 17l3.5-4.5 2.5 3.01L14.5 11l4.5 6H5Z"></path>
                                    </svg>
                                    <p class="upload-file__drop-text">Добавьте или перетащите сюда файл</p>
                                </div>
                                <input type="file" id="file-upload" style="display: none;"/>
                                <p id="file-name-display"></p>
                                <div class="upload-file__add-wrap">
                                    <button class="button button_quaternary button_md add-button upload-file__add"
                                            id="upload-btn" type="button">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="add-button__icon">
                                            <path
                                                d="M19 7v2.99h-2V7h-3V5h3V2h2v3h3v2h-3Zm-3 4V8h-3V5H5a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2v-8h-3ZM5 19l3-4 2 3 3-4 4 5H5Z"></path>
                                        </svg>
                                        Добавить файл с устройства
                                    </button>
                                </div>
                            </div>
                            <div class="mt-10 grid gap-5 sm:grid-cols-2">
                                <button class="button button_primary button_md" type="submit">
                                    Добавить позицию
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
            <div class="create-order__search-wrap">
                <form class="search">
                    <input
                        class="search__input"
                        type="text"
                        required
                        placeholder="Поиск позиции..."
                    />
                    <div class="search__addon">
                        <svg viewBox="0 0 24 24" fill="none" class="search__icon">
                            <g clip-path="url(#search_svg__a)">
                                <path
                                    d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 1 0-.7.7l.27.28v.79l5 4.99L20.49 19l-4.99-5Zm-6 0a4.5 4.5 0 1 1-.01-8.99A4.5 4.5 0 0 1 9.5 14Z"
                                    fill="#989898"
                                ></path>
                            </g>
                            <defs>
                                <clipPath id="search_svg__a">
                                    <path fill="#fff" d="M0 0h24v24H0z"></path>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </form>
            </div>
            <div class="create-order__export-wrap">
                <a class="button button_tertiary button_md add-button w-full" href="#"
                >
                    <svg viewBox="0 0 25 24" fill="currentColor" class="add-button__icon">
                        <path
                            d="M16.97 9h-1.6V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v5H7.8a1 1 0 0 0-.71 1.71l4.59 4.59a1 1 0 0 0 1.4 0l4.6-4.59a1 1 0 0 0-.7-1.71ZM5.37 19a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1h-12a1 1 0 0 0-1 1Z"
                        ></path>
                    </svg
                    >
                    Экспорт заказа в Exel (xslx)</a
                >
            </div>
            <div class="specs">
                <h3 class="specs__head">Общая информация о заказе</h3>
                <div class="specs__content">
                    <dl>
                        <dt>ФИО:</dt>
                        <dd>{{ $userProfile->name }}</dd>
                        <dt>Адрес доставки:</dt>
                        <dd>РФ, г.Москва, ул. Ленина 1</dd>
                        <dt>Телефон:</dt>
                        <dd>{{ $userProfile->phone ?? '-'}}</dd>
                        <dt>Email:</dt>
                        <dd>{{ $userProfile->email ?? '-'}}</dd>
                        <dt>Вес заказа:</dt>
                        <dd>-</dd>
                        <dt>Способ доставки:</dt>
                        <dd>-</dd>
                        <dt>Статус:</dt>
                        <dd>-</dd>
                    </dl>
                </div>
            </div>
            <div class="specs">
                <h3 class="specs__head">Финансовая информация о заказе</h3>
                <div class="specs__content">
                    <dl>
                        <dt>Комиссия:</dt>
                        <dd>-</dd>
                        <dt>Оплачено</dt>
                        <dd>-</dd>
                        <dt>Курс ¥</dt>
                        <dd>-</dd>
                        <dt>Баланс ¥</dt>
                        <dd>-</dd>
                        <dt>Баланс ₽</dt>
                        <dd>-</dd>
                        <dt>Общая сумма заказа:</dt>
                        <dd>-</dd>
                    </dl>
                </div>
            </div>
            <details class="address" open>
                <summary class="button button_primary button_md add-button address__target">
                    <svg viewBox="0 0 24 24" fill="none" class="add-button__icon">
                        <g clip-path="url(#published_svg__a)">
                            <path
                                d="m17.66 9.53-7.07 7.07-4.24-4.24 1.41-1.41 2.83 2.83 5.66-5.66 1.41 1.41ZM4 12a7.95 7.95 0 0 1 2.62-5.88L9 8.5v-6H3l2.2 2.2A10 10 0 0 0 11 21.95v-2.02A8 8 0 0 1 4 12Zm18 0a10 10 0 0 0-9-9.95v2.02a7.95 7.95 0 0 1 4.38 13.81L15 15.5v6h6l-2.2-2.2A9.93 9.93 0 0 0 22 12Z"
                                fill="#fff"
                            ></path>
                        </g>
                        <defs>
                            <clipPath id="published_svg__a">
                                <path fill="#fff" d="M0 0h24v24H0z"></path>
                            </clipPath>
                        </defs>
                    </svg
                    >
                    Адрес доставки
                </summary>
                <div class="address__content">
                    <div class="address__options">
                        @foreach($userProfile->addresses as $address)
                            <label class="checkbox checkbox_text-sm">
                                <input class="checkbox__input single-checkbox" type="checkbox" name="address" data-address_id="{{ $address->id }}"/>
                                <span class="checkbox__control">
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"></path>
                                    </svg>
                                </span>
                                <span class="checkbox__label">
                                    {{ $address->country }}, г. {{ $address->city }}, ул. {{ $address->street }} {{ $address->building }}, кв.{{ $address->apartment }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <button
                        class="button button_quaternary button_md add-button address__button"
                        onclick="createAddress.showModal()"
                        type="button"
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
            </details>
            <dialog class="dialog" id="createAddress">
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
                    <h3 class="dialog__title">Добавить адрес доставки</h3>
                    <form class="create-address">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div class="field col-span-full">
                                <label class="label" for="input-country">Страна:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-country"
                                    name="delivery-country"
                                    required
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-city">Город:</label
                                ><input class="input" type="text" id="input-city" name="delivery-city" required/>
                            </div>
                            <div class="field">
                                <label class="label" for="input-street">Улица:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-street"
                                    name="delivery-street"
                                    required
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-building">Корпус:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-building"
                                    name="delivery-building"
                                    required
                                />
                            </div>
                            <div class="field">
                                <label class="label" for="input-apartment">Квартира, дом:</label
                                ><input
                                    class="input"
                                    type="text"
                                    id="input-apartment"
                                    name="delivery-apartment"
                                    required
                                />
                            </div>
                            <button class="button button_primary button_md" type="submit">
                                Добавить адрес
                            </button
                            >
                            <button
                                class="button button_secondary button_md"
                                onclick="this.closest('dialog').close()"
                                type="reset"
                            >
                                Отменить
                            </button>
                        </div>
                    </form>
                </div>
            </dialog>
        </div>
        <div class="create-order__section">
            <h2 class="create-order__subtitle">Позиции</h2>
            <div class="inventory">
                <table id="orderItemsTable">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Ссылка</th>
                        <th>Дата</th>
                        <th>Цена</th>
                        <th>Кол-во</th>
                        <th>Доставка по Китаю</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="inventory__fallback">
                    Здесь пока ничего нет, нажмите на кнопку «Создать позицию», чтобы добавить товар
                    в заказ
                </div>
            </div>
        </div>
        <div class="order__actions">
            <div class="order__actions-col">
                <button class="button button_secondary button_md w-full" type="button" onclick="cancelOrder()">
                    Отменить заказ
                </button>
            </div>
            <div class="order__actions-col">
                <button class="button button_secondary button_md w-full" type="button" onclick="completeOrder()">
                    Создать заказ
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function cancelOrder() {
            localStorage.removeItem('currentOrderId');

            const form = document.querySelector('.create-product');
            if (form) {
                form.reset();
            }

            window.location.href = '/orders';
        }


        function completeOrder() {
            const orderId = localStorage.getItem('currentOrderId');
            if (!orderId) {
                showErrorAlert('Нет активного заказа для завершения.');
                return;
            }

            const selectedAddressCheckbox = $('input[name="address"]:checked');
            if (!selectedAddressCheckbox.length) {
                showErrorAlert('Пожалуйста, выберите адрес доставки.');
                return;
            }

            const addressId = selectedAddressCheckbox.data('address_id');

            $.ajax({
                url: '{{ route('orders.complete') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {
                    order_id: orderId,
                    address_id: addressId
                },
                success: function (response) {
                    if (response.success) {
                        showSuccessAlert(response.message);
                        localStorage.removeItem('currentOrderId');
                        setTimeout(function() {
                            window.location.href = '/orders';
                        }, 2000);
                    } else {
                        showErrorAlert(response.message);
                    }
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



        function loadOrderItems() {
            const orderId = localStorage.getItem('currentOrderId');
            if (!orderId) {
                console.error('Order ID not found');
                return;
            }

            $.ajax({
                url: `/order/${orderId}/items`,
                type: 'GET',
                success: function (data) {
                    const tableBody = $('#orderItemsTable tbody');
                    if (data.length > 0) {
                        tableBody.empty();

                        data.forEach((item, index) => {
                            const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td><a href="${item.link}" target="_blank">${item.name}</a></td>
                            <td>${new Date(item.created_at).toLocaleDateString()}</td>
                            <td>${item.price}</td>
                            <td>${item.quantity}</td>
                            <td>${item.domestic_shipping_cost || 'N/A'}</td>
                            <td>${item.total_price || 'N/A'}</td>
                        </tr>
                    `;

                            tableBody.append(row);
                        });

                        $('.inventory__fallback').hide();
                    } else {
                        $('.inventory__fallback').show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Ошибка при загрузке позиций заказа:', error);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('file-upload');
            const uploadButton = document.getElementById('upload-btn');
            const fileNameDisplay = document.getElementById('file-name-display');

            dropZone.addEventListener('dragover', function (e) {
                e.preventDefault();
                dropZone.classList.add('upload-file__drop--active');
            });

            dropZone.addEventListener('dragleave', function (e) {
                e.preventDefault();
                dropZone.classList.remove('upload-file__drop--active');
            });

            dropZone.addEventListener('drop', function (e) {
                e.preventDefault();
                dropZone.classList.remove('upload-file__drop--active');
                const files = e.dataTransfer.files;
                handleFiles(files);
            });

            uploadButton.addEventListener('click', function () {
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                const files = fileInput.files;
                handleFiles(files);
            });

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    fileNameDisplay.textContent = `Загружен файл: ${file.name}`;
                    console.log(file);
                }
            }
        });

        $(document).ready(function () {
            $('.create-product').submit(function (event) {
                event.preventDefault();

                let formData = new FormData(this);
                formData.append('order_id', localStorage.getItem('currentOrderId') || '');

                let fileInput = document.getElementById('file-upload');
                if (fileInput.files[0]) {
                    formData.append('file', fileInput.files[0]);
                }

                ['is_photo_report', 'is_measure', 'is_lathing', 'is_comment', 'is_bubble_wrap'].forEach(name => {
                    let checkbox = document.querySelector(`input[name="${name}"]`);
                    if (formData.has(name)) {
                        formData.set(name, checkbox.checked ? '1' : '0');
                    } else {
                        formData.append(name, checkbox.checked ? '1' : '0');
                    }
                });


                $.ajax({
                    url: '{{ route('orders.storeItem') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        if (response.success && response.data.orderId) {
                            localStorage.setItem('currentOrderId', response.data.orderId);

                            document.getElementById('createProduct').close();
                            $('.create-product')[0].reset();

                            showSuccessAlert(response.message);

                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            alert('Order created but no ID returned');
                        }
                    },
                    error: function (xhr, status, error) {
                        $('.form-error').remove();

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;

                            for (let key in errors) {
                                let errorMessages = errors[key].join(' ');
                                let input = $(`[name=${key}]`);
                                input.after(`<div class="form-error text-danger">${errorMessages}</div>`);

                                input.closest('.form-group').addClass('has-error');
                            }
                        } else {
                            console.error('Error:', error);
                            showErrorAlert('Ошибка при добавлении позиции');
                        }
                    }
                });

            });

            $('#drop-zone input[type="file"]').change(function (event) {
                const fileInput = event.target;
                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const previewHtml = `<img src="${e.target.result}" alt="Preview" class="upload-file__thumb"/>`;
                        $('#drop-zone').html(previewHtml);
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });

        $(document).ready(function () {
            loadOrderItems();
        });

        $(document).ready(function () {
            $('.create-address').submit(function (event) {
                event.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route("user.addAddress") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        if (response.success) {
                            document.getElementById('createAddress').close();
                            showSuccessAlert(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
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
                            showErrorAlert('Ошибка при добавлении адреса');
                        }
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.single-checkbox');
            checkboxes.forEach(chk => {
                chk.addEventListener('change', function () {
                    checkboxes.forEach(box => {
                        if (box !== chk) {
                            box.checked = false;
                            box.removeAttribute('checked');
                        } else {
                            box.setAttribute('checked', 'checked');
                        }
                    });
                });
            });
        });


    </script>
@endsection
