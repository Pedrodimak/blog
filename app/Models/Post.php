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
        'category',
        'user_id'
    ];

    public function getKeyName()
    {
        return 'id';
    }
}
