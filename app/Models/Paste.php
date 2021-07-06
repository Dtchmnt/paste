<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    use HasFactory;


    protected $fillable = [
        'link',
        'name',
        'title',
        'text',
        'privacy',
        'expiration',
        'user_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
