<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory,SoftDeletes;

    public function users(){
        return $this->belongsToMany(User::class,'item_user', 'item_id', 'user_id')->withTimestamps();

    }
    public function itemDetails()
    {
        return $this->hasMany(ItemDetail::class);
    }
}
