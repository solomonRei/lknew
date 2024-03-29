@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @include('components.info-bar')
    <hr class="layout__divider" />
    <nav class="layout__breadcrumb"><a href="#">Главная</a> / Мои заказы</nav>
    <div class="layout__head"><h1 class="layout__title">Мои заказы</h1></div>
    <div class="orders">
        <div class="orders__hoods-wrap">
            <div class="orders__hoods" role="tablist">
                <button
                    type="button"
                    class="orders__hood"
                    role="tab"
                    aria-selected="true"
                    aria-controls="tabpanel-orders"
                >
                    Заказы</button
                ><button
                    type="button"
                    class="orders__hood"
                    role="tab"
                    aria-selected="false"
                    aria-controls="tabpanel-shipments"
                >
                    Отгрузки
                </button>
            </div>
            <div class="orders__note">
                <svg viewBox="0 0 24 24" fill="none" class="orders__note-icon">
                    <g clip-path="url(#announcement_svg__a)">
                        <path
                            d="M20 2H4a2 2 0 0 0-1.99 2L2 22l4-4h14a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Zm-7 9h-2V5h2v6Zm0 4h-2v-2h2v2Z"
                            fill="#323232"
                        ></path>
                    </g>
                    <defs>
                        <clipPath id="announcement_svg__a">
                            <path fill="#fff" d="M0 0h24v24H0z"></path>
                        </clipPath>
                    </defs>
                </svg>
                <div>Минимальная сумма заказа от <nobr>10 000 ¥</nobr></div>
            </div>
        </div>
        <div id="tabpanel-orders" role="tabpanel" class="orders__pane">
            <div class="orders__tabs">
                <div class="orders__tabs-content" role="tablist">
                    <button
                        type="button"
                        class="orders__tab"
                        role="tab"
                        aria-selected="true"
                        aria-controls="tabpanel-orders-active"
                    >
                        Активные</button
                    ><button
                        type="button"
                        class="orders__tab"
                        role="tab"
                        aria-selected="false"
                        aria-controls="tabpanel-orders-clarification"
                    >
                        Требуется уточнение</button
                    ><button
                        type="button"
                        class="orders__tab"
                        role="tab"
                        aria-selected="false"
                        aria-controls="tabpanel-orders-done"
                    >
                        Завершенные
                    </button>
                </div>
            </div>
            <div id="tabpanel-orders-active" role="tabpanel" class="orders__panel">
                <div class="inventory">
                    <table>
                        <thead>
                        <tr>
                            <th>№ Заказа</th>
                            <th>Дата создания</th>
                            <th>Изменен</th>
                            <th>Позиции</th>
                            <th>Сумма</th>
                            <th>Баланс</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><a class="inventory__link" href="{{ route('order.show', $order->id) }}"></a>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d.m.Y') }}</td>
                                <td>{{ $order->updated_at->format('d.m.Y') }}</td>
                                <td>{{ $order->items->count() }}</td>
                                <td><nobr>{{ number_format($order->total_amount, 2, ' ', ' ') }} ¥</nobr></td>
                                <td><nobr>{{ number_format($order->total_paid, 2, ' ', ' ') }} ¥</nobr></td>
                                <td>
                                    <div class="order-status order-status_{{ strtolower($order->status) }}">
                                        <span class="order-status__text">{{ __('orders.status.' . $order->status) }}</span>
                                        <span class="order-status__pointer"></span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                id="tabpanel-orders-clarification"
                role="tabpanel"
                class="orders__panel"
                hidden
            >
                <div class="inventory">
                    <table>
                        <thead>
                        <tr>
                            <th>№ Заказа</th>
                            <th>Дата создания</th>
                            <th>Изменен</th>
                            <th>Позиции</th>
                            <th>Сумма</th>
                            <th>Баланс</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                    </table>
                    <div class="inventory__fallback">
                        Здесь пока ничего нет, нажмите на кнопку «Создать заказ»
                    </div>
                </div>
            </div>
            <div id="tabpanel-orders-done" role="tabpanel" class="orders__panel" hidden>
                <div class="inventory">
                    <table>
                        <thead>
                        <tr>
                            <th>№ Заказа</th>
                            <th>Дата создания</th>
                            <th>Изменен</th>
                            <th>Позиции</th>
                            <th>Сумма</th>
                            <th>Баланс</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                    </table>
                    <div class="inventory__fallback">
                        Здесь пока ничего нет, нажмите на кнопку «Создать заказ»
                    </div>
                </div>
            </div>
        </div>
        <div id="tabpanel-shipments" role="tabpanel" class="orders__pane" hidden>
            <div class="orders__tabs">
                <div class="orders__tabs-content" role="tablist">
                    <button
                        type="button"
                        class="orders__tab"
                        role="tab"
                        aria-selected="true"
                        aria-controls="tabpanel-shipments-active"
                    >
                        Активные</button
                    ><button
                        type="button"
                        class="orders__tab"
                        role="tab"
                        aria-selected="false"
                        aria-controls="tabpanel-shipments-done"
                    >
                        Завершенные
                    </button>
                </div>
            </div>
            <div id="tabpanel-shipments-active" role="tabpanel" class="orders__panel">
                <div class="inventory">
                    <table>
                        <thead>
                        <tr>
                            <th>№ Заказа</th>
                            <th>Дата отправки со склада в Китае</th>
                            <th>Примерная дата прибытия груза</th>
                            <th>Способ доставки</th>
                            <th>Вес, кг</th>
                            <th>Объём, m³</th>
                            <th>Тариф, ₽</th>
                            <th>Сумма к оплате, ₽</th>
                            <th>Упаковочный лист</th>
                            <th>Накладная ТК</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        <tr>
                            <td><a class="inventory__link" href="order"></a>123456</td>
                            <td>15.01.2024</td>
                            <td>17.03.2024</td>
                            <td>Авиа</td>
                            <td>16</td>
                            <td>5</td>
                            <td><nobr>3 345</nobr></td>
                            <td><nobr>123 456</nobr></td>
                            <td>Да</td>
                            <td>Да</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="tabpanel-shipments-done" role="tabpanel" class="orders__panel" hidden>
                <div class="inventory">
                    <table>
                        <thead>
                        <tr>
                            <th>№ Заказа</th>
                            <th>Дата отправки со склада в Китае</th>
                            <th>Примерная дата прибытия груза</th>
                            <th>Способ доставки</th>
                            <th>Вес, кг</th>
                            <th>Объём, m³</th>
                            <th>Тариф, ₽</th>
                            <th>Сумма к оплате, ₽</th>
                            <th>Упаковочный лист</th>
                            <th>Накладная ТК</th>
                        </tr>
                        </thead>
                    </table>
                    <div class="inventory__fallback">Здесь пока нет завершенных заказов</div>
                </div>
            </div>
        </div>
    </div>
@endsection
