<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashiers extends Model
{
    use HasFactory;
    protected $table = 'cashiers';

    protected $fillable = ['nama_kasir',];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
