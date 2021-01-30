<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContactUs extends Model
{
    use HasFactory;
    
    protected $table = 'customer_contact_us';

    public $primaryKey = 'id';

    protected $fillable = [
        'name','email','phone_number','subject','message'
    ];

}
