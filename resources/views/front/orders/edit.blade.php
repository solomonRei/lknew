@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @include('components.info-bar')
    <hr class="layout__divider"/>
    <nav class="layout__breadcrumb"><a href="#">Главная</a> / Редактировать заказ</nav>
    <div class="layout__head"><h1 class="layout__title">Редактировать заказ</h1></div>
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
                                    onclick="this.closest('dialog').close()"
                                    type="reset"
                                >
                                    Отменить
                                </button>
                            </div>
                        </form>
                    </div>
                </dialog>

                <dialog class="dialog" id="editProduct">
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
                        <h3 class="dialog__title">Редактировать позицию</h3>
                        <form class="edit-product">
                            <input type="hidden" name="id" id="edit-item-id" />
                            <div class="mb-10 grid gap-5 sm:grid-cols-4">
                                <div class="field col-span-full">
                                    <label class="label" for="input-link">Ссылка</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="edit-input-link"
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
                                        id="edit-input-name"
                                        name="name"
                                        required
                                    />
                                </div>
                                <div class="field">
                                    <label class="label" for="input-price">Цена ¥</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="edit-input-price"
                                        name="price"
                                        required
                                    />
                                </div>
                                <div class="field">
                                    <label class="label" for="input-quantity">Количество</label
                                    ><input
                                        class="input"
                                        type="text"
                                        id="edit-input-quantity"
                                        name="quantity"
                                        required
                                    />
                                </div>
                            </div>
                            <h4 class="create-product__subtitle">Дополнительные услуги:</h4>
                            <div class="mb-5 grid gap-5 sm:grid-cols-2">
                                <label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" id="edit-is-photo-report" name="edit_is_photo_report"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label">Заказать фото отчет</span></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" id="edit-is-lathing" name="edit_is_lathing"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label">Добавить обрешетку</span></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" id="edit-is-measure" name="edit_is_measure"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span
                                    ><span class="checkbox__label">Заказать замер</span></label
                                ><label class="checkbox" style=""
                                ><input class="checkbox__input" type="checkbox" id="edit-is-bubble-wrap" name="edit_is_bubble_wrap"/><span
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
                                ><input class="checkbox__input" type="checkbox" id="edit-is-comment" name="edit_is_comment"/><span
                                        class="checkbox__control"
                                        aria-hidden="true"
                                    ><svg viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"
                                ></path></svg></span><span class="checkbox__label">Добавить другие услуги в комментарии</span></label>
                            </div>
                            <div class="mb-10">
                          <textarea
                              class="input"
                              id="edit-input-quantity"
                              name="comment"
                              rows="5"
                              placeholder="Напишите ваш комментарий по заказу..."
                          ></textarea>
                            </div>
                            <!--
                            <h4 class="create-product__subtitle">Добавить изображение</h4>

                            <div class="upload-file">
                                <div class="upload-file__drop" id="drop-zone">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="upload-file__drop-icon">
                                        <path
                                            d="M21 3H3C2 3 1 4 1 5v14c0 1.1.9 2 2 2h18c1 0 2-1 2-2V5c0-1-1-2-2-2ZM5 17l3.5-4.5 2.5 3.01L14.5 11l4.5 6H5Z"></path>
                                    </svg>
                                    <p class="upload-file__drop-text">Добавьте или перетащите сюда файл</p>
                                </div>
                                <div id="edit-photo-preview">
                                </div>
                                <button type="button" id="edit-remove-photo" style="display: none;">Удалить фото</button>
                                <input type="file" id="file-upload" style="display: none;"/>
                                <p id="edit-file-name-display"></p>
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
                            -->
                            <div class="mt-10 grid gap-5 sm:grid-cols-2">
                                <button class="button button_primary button_md" type="submit">
                                    Редактировать позицию
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
            <div class="create-order__search-wrap"></div>
            <div class="create-order__export-wrap">
                <a class="button button_tertiary button_md add-button w-full" href="{{ route('orders.export', $order->id) }}"
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
                        <dd>{{ $order->address->formatted_address ?? '-' }}</dd>
                        <dt>Телефон:</dt>
                        <dd>{{ $order->user->profile->phones->first()->number ?? '-' }}</dd>
                        <dt>Email:</dt>
                        <dd>{{ $order->user->email ?? '-' }}</dd>
                        <dt>Вес заказа:</dt>
                        <dd>{{ $order->total_weight ?? '0' }} кг</dd>
                        <dt>Способ доставки:</dt>
                        <dd>{{ $order->shipping_method ?? '-' }}</dd>
                        <dt>Статус:</dt>
                        <dd>
                            <div class="order-status order-status_created">
                                <span class="order-status__text">{{ __('orders.status.' . $order->status) }}</span>
                            </div>
                        </dd>
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
                                <input class="checkbox__input single-checkbox" type="checkbox" name="address"
                                       data-address_id="{{ $address->id }}"
                                    {{ $order->address_id == $address->id ? 'checked' : '' }}/>
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
                <button class="button button_secondary button_md w-full delete_order_btn" type="button"
                        data-order-id="{{ $order->id }}"

                        @if($order->status === 'not_created')
                        data-action-url="{{ route('order.delete', $order->id) }}"
                        @else
                        data-action-url="{{ route('order.cancel', $order->id) }}"
                    @endif
                >
                    @if($order->status === 'not_created') Удалить заказ @else Отменить заказ @endif
                </button>
            </div>
            <div class="order__actions-col">
                <button class="button button_secondary button_md w-full" type="button" onclick="completeOrder()">
                    Сохранить заказ
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        localStorage.setItem('currentOrderId', '{{ $order->id }}');
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
                        setTimeout(function () {
                            window.location.href = '/orders';
                        }, 2000);
                    } else {
                        showErrorAlert(response.message);
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
        function editItem() {
            const itemId = $(this).data('item-id');
            console.log(itemId)

            $.ajax({
                url: '/item/get/' + itemId,
                type: 'GET',
                success: function(response) {
                    if (response.success && response.data.orderItem) {
                        const item = response.data.orderItem;

                        $('#edit-input-link').val(item.link);
                        $('#edit-input-name').val(item.name);
                        $('#edit-input-price').val(item.price);
                        $('#edit-input-quantity').val(item.quantity);
                        $('#edit-item-id').val(item.id);

                        $('#edit-is-photo-report').prop('checked', response.data.orderItem.is_photo_report === 1);
                        $('#edit-is-measure').prop('checked', response.data.orderItem.is_measure === 1);
                        $('#edit-is-lathing').prop('checked', response.data.orderItem.is_lathing === 1);
                        $('#edit-is-bubble-wrap').prop('checked', response.data.orderItem.is_bubble_wrap === 1);
                        $('#edit-is-comment').prop('checked', response.data.orderItem.is_comment === 1);
                        $('#edit-input-comment').val(item.comment);

                        if (item.photos.length > 0) {
                            const photoPath = '/storage/' + item.photos[0].file_path;
                            const photoPreviewHtml = `<img src="${photoPath}" alt="Фото" style="max-width: 100px; max-height: 100px;">`;
                            $('#edit-photo-preview').html(photoPreviewHtml);
                            // $('#edit-remove-photo').show();
                        } else {
                            $('#edit-photo-preview').html('Нет загруженных фото');
                            // $('#edit-remove-photo').hide();
                        }

                        document.getElementById('editProduct').showModal();
                    } else {
                        showErrorAlert('Позиция не найдена или ошибка в данных.');
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
                        showErrorAlert('Ошибка при редактировании');
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
                        <tr id="item-row-${item.id}">
                            <td>${index + 1}</td>
                            <td><a href="${item.link}" target="_blank">${item.name}</a></td>
                            <td>${new Date(item.created_at).toLocaleDateString()}</td>
                            <td>${item.price}</td>
                            <td>${item.quantity}</td>
                            <td>${item.domestic_shipping_cost || 'N/A'}</td>
                            <td>
                                <div class="order__group">
                                    <nobr> ${item.total_price || 'N/A'} </nobr>
                                    <div class="edit-controls">
                                            <button type="button" class="edit-controls__button edit-item-button"  data-item-id="${item.id}" onclick="editItem.call(this)">
                                                <svg viewBox="0 0 20 20" fill="currentColor" class="edit-controls__icon">
                                                    <path d="M2.5 14.38v3.12h3.13l9.21-9.22-3.12-3.12-9.22 9.21Zm14.76-8.51a.83.83 0 0 0 0-1.18L15.3 2.74a.83.83 0 0 0-1.18 0L12.6 4.27l3.12 3.12 1.53-1.52Z"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="edit-controls__button" data-item-id="${item.id}" onclick="deleteItem.call(this)">
                                                <svg viewBox="0 0 20 20" fill="currentColor" class="edit-controls__icon">
                                                    <path d="M5 15.83c0 .92.75 1.67 1.67 1.67h6.66c.92 0 1.67-.75 1.67-1.67v-10H5v10Zm10.83-12.5h-2.91l-.84-.83H7.92l-.84.83H4.17V5h11.66V3.33Z"></path>
                                                </svg>
                                            </button>
                                    </div>
                                </div>
                            </td>
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
            $('.edit-product').submit(function (event) {
                event.preventDefault();

                let itemId = $('#edit-item-id').val();
                let url = `/order/item/${itemId}/update`;

                let formData = new FormData(this);
                formData.append('order_id', localStorage.getItem('currentOrderId') || '');

                let fileInput = document.getElementById('file-upload');
                if (fileInput.files[0]) {
                    formData.append('file', fileInput.files[0]);
                }

                ['edit_is_photo_report', 'edit_is_measure', 'edit_is_lathing', 'edit_is_comment', 'edit_is_bubble_wrap'].forEach(name => {
                    let checkbox = document.querySelector(`input[name="${name}"]`);
                    if (formData.has(name)) {
                        formData.set(name, checkbox.checked ? '1' : '0');
                    } else {
                        formData.append(name, checkbox.checked ? '1' : '0');
                    }
                });


                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        if (response.success && response.data.orderItem) {

                            document.getElementById('editProduct').close();
                            $('.edit-product')[0].reset();

                            showSuccessAlert(response.message);

                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            alert('Item edited but no ID returned');
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

            $('.delete_order_btn').on('click', function () {
                const orderId = $(this).data('order-id');
                const actionUrl = $(this).data('action-url');

                if (!orderId || !actionUrl) {
                    showErrorAlert('Некорректные данные');
                    return;
                }

                if (confirm('Вы уверены?')) {
                    $.ajax({
                        url: actionUrl,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            order_id: orderId
                        },
                        success: function (response) {

                            if (response.success) {
                                showSuccessAlert(response.message);
                                localStorage.removeItem('currentOrderId');
                                const form = document.querySelector('.create-product');
                                if (form) {
                                    form.reset();
                                }
                                setTimeout(function () {
                                    window.location.href = '/orders';
                                }, 2000);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Ошибка:', error);
                            showErrorAlert('Произошла ошибка при выполнении операции.');
                        }
                    });
                }
            });
        });
        $(document).ready(function () {

            $('.edit-item-button').on('click', function() {
                const itemId = $(this).data('item-id');
                console.log(itemId)

                $.ajax({
                    url: '/item/get/' + itemId,
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#input-link').val(response.data.link);
                            $('#input-name').val(response.data.name);
                            $('#input-price').val(response.data.price);
                            $('#input-quantity').val(response.data.quantity);

                            $('#editModal').modal('show');
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

        function deleteItem() {
            const itemId = $(this).data('item-id');
            if (!confirm('Вы уверены, что хотите удалить этот элемент?')) {
                return;
            }

            $.ajax({
                url: `/order-item/${itemId}/delete`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showSuccessAlert(response.message);
                        $(`#item-row-${itemId}`).remove();

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
                        showErrorAlert('Ошибка при редактировании');
                    }
                }
            });
        }


    </script>
@endsection
