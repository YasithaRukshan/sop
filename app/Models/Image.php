<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    protected $table = 'images';

    public $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];

    public function createdUser(){
        return $this->hasOne('App\User', 'user_id', 'added_by');
    }

    public function itemImages()
    {
        return $this->hasMany('App\ItemImage', 'image_id', 'id');
    }

    public function slider(){
        return $this->hasOne('App\Slider', 'image_id', 'image_id');
    }
}
