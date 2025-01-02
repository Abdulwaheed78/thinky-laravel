<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    use HasFactory;
    protected $table = 'natures';
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'nature_id');
    }
}
