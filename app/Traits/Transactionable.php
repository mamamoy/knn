<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Transactionable
{
    public function transaction(\Closure $callback)
    {
        return DB::transaction($callback);
    }

    public function lockForUpdate()
    {
        return $this->getQuery()->lockForUpdate();
        
    }
    
    public function commit()
    {
        return DB::commit();
    }

    public function rollBack()
    {
        return DB::rollBack();
    }
}