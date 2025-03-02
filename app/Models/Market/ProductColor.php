<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'product_colors';
    protected $fillable = ['product_id','color', 'color_name','price_increase','sold_number','frozen_number','status'];
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
