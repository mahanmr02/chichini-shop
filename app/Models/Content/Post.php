<?php

namespace App\Models\Content;

use App\Models\Content\Comment;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $casts = ['image'=>'array'];
    protected $fillable = ['title','slug','summary','body','image','status','published_at','author_id','category_id','commentable','tags'];
    public $incrementing = false;

    public function postCategory(){
        return $this->belongsTo(PostCategory::class,'category_id');
    }
    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
}
