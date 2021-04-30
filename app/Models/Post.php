<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id'
    ];

    public function getKeyName()
    {
        return 'id';
    }

    public function category()
    {
        //Un post pertenece a una categoría
        return $this->belongsTo(Category::class, 'category_id');
    }
}
