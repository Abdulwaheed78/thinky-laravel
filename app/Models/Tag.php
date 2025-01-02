<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    // Tag model
    public function blog_tags()
    {
        return $this->belongsTo(Tag::class, 'id');
    }
}
