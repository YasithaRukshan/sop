<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMessages extends Model
{
    use HasFactory;
    protected $table = 'customer_messages';

    public $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'message', 'from_who', 'message_read'
    ];

    public function Customer()
    {
        return $this->belongsTo('App\Models\Customer', 'user_id', 'id');
    }
}
