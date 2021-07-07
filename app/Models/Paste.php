<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'syntax',
        'user_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function expiration($pastes, $isList)
    {
        if(!$isList)
        {
            $pastes = [$pastes];
        }
        foreach ($pastes as $key => $paste)
        {
            $time_ago = time() - strtotime($paste->created_at);
            $minutes = round($time_ago/60);
            $hours = round($time_ago/60/60);
            $days = round($time_ago/60/60/24);
            $weeks = round($time_ago/60/60/24/7);

            if(($paste->expiration == 0 && $minutes > 10) ||
                ($paste->expiration == 1 && $hours > 1) ||
                ($paste->expiration == 2 && $hours > 3) ||
                ($paste->expiration == 3 && $days > 1) ||
                ($paste->expiration == 4 && $weeks > 1) ||
                ($paste->expiration == 5 && $weeks > 30))
                unset($pastes[$key]);
        }
        return $pastes;
    }
}
