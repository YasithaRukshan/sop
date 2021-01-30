<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerContact extends Model
{
    use HasFactory;
    
    protected $table = 'owner_contact';

    public $primaryKey = 'id';

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'city', 
        'state',
        'wells_num', 
        'depth',
        'production', 
        'avg_bopd', 
        'avg_tot_bopd',
        'pump_status',
        'user_status',
        'status',
        'reason'
    ];
}
