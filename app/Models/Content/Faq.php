<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory,SoftDeletes,Sluggable;
    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'question'
            ]
        ];
    }
    protected $casts = ['image'=>'array'];
    protected $fillable = ['question','answer','slug','status','tags'];
    public $incrementing = false;
}
