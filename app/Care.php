<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// 照顧/託管紀錄
class Care extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pet_id', 'experience', 'is_foster'

    ];

}