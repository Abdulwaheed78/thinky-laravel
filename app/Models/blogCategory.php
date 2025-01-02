<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogCategory extends Model
{
    use HasFactory;
    protected $table='blog_categorys';
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function category(){
        return $this->hasMany(Category::class,'id');
    }
}
