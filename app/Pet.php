<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'city_id', 'category_id', 'name', 'color', 'age', 'img_url', 'personality', 'is_host'

    ];

}