<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'link',
        'name',
        'price',
        'quantity',
        'domestic_shipping_cost',
        'total_price',
        'is_photo_report',
        'is_measure',
        'is_lathing',
        'is_bubble_wrap',
        'is_comment',
        'comment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    public function photos()
    {
        return $this->hasMany(OrderItemPhoto::class);
    }

}
