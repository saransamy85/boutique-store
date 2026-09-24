<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    //
    protected $fillable = [
        'order_number',
        'customer_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'subtotal',
        'shipping_charge',
        'total_amount',
        'payment_method',
        'payment_status',
        'payment_screenshot',
        'order_status',
        'notes',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
