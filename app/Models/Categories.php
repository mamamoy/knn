<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['nama_category',];

    public function items()
    {
        return $this->hasMany(Items::class);
    }
    public function orderitems()
    {
        return $this->hasMany(Items::class);
    }
}
