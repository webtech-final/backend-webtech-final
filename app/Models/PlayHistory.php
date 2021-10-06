<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayHistory extends Model
{
    use HasFactory;

    protected  $attributes = [
        'opponent' => "",
        'result' => 'WIN'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
