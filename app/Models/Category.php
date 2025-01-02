<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categorys';
    public function blog_category()
    {
        return $this->belongsTo(blogCategory::class, 'category_id');
    }
}
