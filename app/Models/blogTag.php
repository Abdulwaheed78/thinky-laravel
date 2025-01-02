<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogTag extends Model
{
    use HasFactory;
    protected $table = 'blog_tags';
    // BlogTag model
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function tag()
    {
        return $this->hasMany(BlogTag::class, 'tag_id');
    }
}
