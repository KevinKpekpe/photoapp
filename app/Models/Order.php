<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'code',
        'actif'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Si vous avez besoin d'une relation pour un seul paiement (peut-être le plus récent?)
    public function payment()
    {
        return $this->hasOne(Payment::class)->latest();
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'order_coupons')->withPivot('discount_amount');
    }
}
