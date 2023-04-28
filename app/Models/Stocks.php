<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Transactionable;

class Stocks extends Model
{
    use HasFactory;
    use Transactionable;

    protected $table='stocks';
    protected $fillable = ['items_id','jumlah'];

    public function item(){
        return $this->belongsTo(Items::class, 'items_id');
    }
}
