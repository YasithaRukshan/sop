<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $fillable = [
         'msg','read'
    ];

    public function totalCountOfNotification(){
        return Notification::where('read',0)->count('*');
    }

    public function newNotification(){
        return Notification::where('read',0)->get();
    }
}
