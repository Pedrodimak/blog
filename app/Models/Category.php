<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'title',
        'created_at',
        'updated_at',
    ];

    public function getKeyName()
    {
        return 'id';
    }

    /*public function post()
    {
        return $this->belongTo(Post::class);
    }*/
}
