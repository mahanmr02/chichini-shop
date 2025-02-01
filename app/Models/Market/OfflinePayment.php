<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfflinePayment extends Model
{
    use HasFactory;

    public function payments(){
        return $this->morphMany('App\Models\Market\Payment','paymentable');
    }
}
