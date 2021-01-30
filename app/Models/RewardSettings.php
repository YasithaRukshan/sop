<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardSettings extends Model
{
    use HasFactory;

    protected $table = 'reward_settings';

    public $primaryKey = 'id';

    protected $fillable = [
        'name', 'value'
    ];
}