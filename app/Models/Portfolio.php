<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'slug',
        'intro',
        'description',
        'image_id',
        'price',
        'status',
        'cor',
        'geo',
        'oigcc'
    ];

    /**
     * images
     *
     * @return void
     */
    public function images()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
    /**
     * contracts
     *
     * @return void
     */
    public function contracts(){
        return $this->hasMany(Contract::class,'portfolio_id');
    }
    /**
     * contractSum
     *
     * @return void
     */
    public function contractSum(){
        return $this->hasMany(Contract::class,'portfolio_id')->sum('amount');
    }
}
