<?php


namespace App\Enums;


class OrderStatus
{
    public const CREATED = 'Заявка создана';
    public const FORM_CHECKING = 'Проверка бланка';
    public const PAID = 'Оплачено';
    public const PURCHASED = 'Выкуп';
    public const ARRIVED_AT_WAREHOUSE = 'Прибыло на склад';
    public const SHIPPED_FROM_CN = 'Отправлено из КНР';
    public const DELIVERED_IN_RF = 'Доставлено в РФ';
    public const CANCELLED = 'Заявка отменена';
}
