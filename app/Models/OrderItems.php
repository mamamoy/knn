<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Transactionable;

class OrderItems extends Model
{
    use HasFactory;
    use Transactionable;
    protected $table = 'order_items';
    protected $fillable = [
        'items_id',
        'order_id',
        'jumlah',
        'harga_total',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'items_id');
    }
    
}
