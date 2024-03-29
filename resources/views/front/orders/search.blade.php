@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @include('components.info-bar')
    <hr class="layout__divider" />
    <nav class="layout__breadcrumb"><a href="#">Главная</a> / Поиск</nav>
    <div class="layout__head"><h1 class="layout__title">Найденные заказы</h1></div>
    <div class="orders">
        <div class="orders__hoods-wrap">

        </div>
        <div id="tabpanel-orders" role="tabpanel" class="orders__pane">
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
                                <td><a class="inventory__link" href="{{ route('order.show', ['order' => $order['id']]) }}"></a>{{ $order['id'] }}</td>
                                <td>{{ $order['created_at'] }}</td>
                                <td>{{ $order['updated_at'] }}</td>
                                <td>{{ $order['items_count'] }}</td>
                                <td><nobr>{{ $order['total_amount'] }}</nobr></td>
                                <td><nobr>{{ $order['user_balance'] }}</nobr></td>
                                <td>
                                    <div class="order-status order-status_{{ strtolower($order['status']) }}">
                                        <span class="order-status__text">{{ $order['status_text'] }}</span>
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
    </div>
@endsection
