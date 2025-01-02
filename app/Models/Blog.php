<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'detail',
        'image',
        'nature_id',
        'author_id',
        'status',
        'is_deleted'
    ];

    // Blog model
    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'blog_id');
    }


    public function categories()
    {
        return $this->hasMany(BlogCategory::class, 'blog_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function nature()
    {
        return $this->belongsTo(Nature::class, 'nature_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

}
