<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table ='authors';

    public function blogs(){
        return $this->hasMany(Blog::class,'author_id');
    }
}
