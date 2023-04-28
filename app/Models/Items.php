<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Transactionable;

class Items extends Model
{
    use HasFactory;
    use Transactionable;

    protected $table='items';
    protected $fillable = ['category_id', 'harga', 'barcode', 'nama_barang'];

    public function stocks(){
        return $this->hasOne(Stocks::class, 'items_id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
