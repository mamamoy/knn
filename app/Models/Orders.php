<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Transactionable;


class Orders extends Model
{
    use HasFactory;
    use Transactionable;
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'cashier_id', 'status'];

    public function cashiers()
    {
        return $this->belongsTo(Cashiers::class, 'cashier_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
