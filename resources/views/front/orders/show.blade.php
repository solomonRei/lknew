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
                15.01.2024<button class="info-bar__item-refresh" type="button">
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
    <hr class="layout__divider" />
    <nav class="layout__breadcrumb"><a href="#">Главная</a> / Заказы / Заказ #{{ $order->id }}</nav>
    <div class="layout__head"><h1 class="layout__title">Заказ #{{ $order->id }}</h1></div>
    <div class="order">
        <div class="order__content">
            <div class="order__status">
                <div class="order-stage">
                    <div class="order-stage__legend">Статус заказа</div>
                    <div class="order-stage__items">
                        @php
                            $stages = [
                                'not_created' => 'Черновик',
                                'pending' => 'Заявка создана',
                                'checked' => 'Проверка бланка',
                                'paid' => 'Оплачено',
                                'purchased' => 'Выкуп',
                                'warehouse' => 'Прибыло на склад',
                                'shipped' => 'Отправлено из Китая',
                                'delivered' => 'Доставлено в России'
                            ];
                            $currentStatus = $order->status ?? 'not_created';
                        @endphp
                        @foreach($stages as $status => $label)
                            <div class="order-stage__item" @if($status === $currentStatus) data-state="current" @endif>
                                <div class="order-stage__circle">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="order-stage__icon">
                                        <path d="M8.25 12.13 5.69 9.57l-.86.85 3.42 3.42 7.31-7.32-.85-.85-6.46 6.46Z"></path>
                                    </svg>
                                </div>
                                <p class="order-stage__label">{{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="order__address">
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
                            </defs></svg
                        >Адрес доставки
                    </summary>
                    <div class="address__content">
                        <p class="address__text">
                            {{ $order->address->formatted_address ?? '-' }}
                        </p>
                    </div>
                </details>
            </div>
            <div class="order__specs-wrap">
                <div class="specs">
                    <h3 class="specs__head">Общая информация о заказе</h3>
                    <div class="specs__content">
                        <dl>
                            <dt>ФИО:</dt>
                            <dd>{{ $order->user->profile->name ?? '-' }}</dd>
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
            </div>
            <div class="order__specs-wrap">
                <div class="specs">
                    <h3 class="specs__head">Финансовая информация о заказе</h3>
                    <div class="specs__content">
                        <dl>
                            <dt>Комиссия:</dt>
                            <dd>1 234 ¥</dd>
                            <dt>Оплачено</dt>
                            <dd>123 456 ¥</dd>
                            <dt>Курс ¥</dt>
                            <dd>13.10 ¥</dd>
                            <dt>Баланс ¥</dt>
                            <dd>123 456 ¥</dd>
                            <dt>Баланс ₽</dt>
                            <dd>12 345 ¥</dd>
                            <dt>Общая сумма заказа:</dt>
                            <dd>123 456 789 ¥</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="order__export-wrap">
                <a class="button button_tertiary button_md add-button w-full" href="{{ route('orders.export', $order->id) }}"
                ><svg viewBox="0 0 25 24" fill="currentColor" class="add-button__icon">
                        <path
                            d="M16.97 9h-1.6V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v5H7.8a1 1 0 0 0-.71 1.71l4.59 4.59a1 1 0 0 0 1.4 0l4.6-4.59a1 1 0 0 0-.7-1.71ZM5.37 19a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1 1 1 0 0 0-1-1h-12a1 1 0 0 0-1 1Z"
                        ></path></svg
                    >Экспорт заказа в Exel (xslx)</a
                >
            </div>
        </div>
        <div class="order__section">
            <h2 class="order__subtitle">Позиции</h2>
            <div class="inventory">
                <table>
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
                    <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ $item->link }}" class="product-inline">
                                    @if($item->photos->first())
                                        <img src="{{ asset('storage/' . $item->photos->first()->file_path) }}" class="product-inline__img" />
                                    @else
                                        <img src="https://placehold.co/40" class="product-inline__img" />
                                    @endif
                                    <p class="product-inline__name">{{ $item->name }}</p>
                                </a>
                            </td>
                            <td>{{ $item->created_at->format('d.m.Y') }}</td>
                            <td><nobr>{{ number_format($item->price, 2) }} ¥</nobr></td>
                            <td>{{ $item->quantity }}</td>
                            <td><nobr>{{ number_format($item->domestic_shipping_cost, 2) }} ¥</nobr></td>
                            <td>
                                <div class="order__group">
                                    <nobr>{{ number_format($item->total_price, 2) }} ¥</nobr>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="order__actions">
            <div class="order__actions-col">
                <button class="button button_secondary button_md w-full" type="button">
                    Отменить заказ
                </button>
                <p class="order__note">
                    Если заказ не перешел в статус «Выкуп», вы можете редактировать или отменить его
                </p>
            </div>
            <div class="order__actions-col">
                <button class="button button_secondary button_md w-full" type="button" data-order-id="{{ $order->id }}">
                    Редактировать заказ
                </button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.order__actions-col .button').click(function() {
                var orderId = $(this).data('order-id');
                if (orderId) {
                    window.location.href = `/orders/edit/${orderId}`;
                }
            });
        });
    </script>
@endsection
