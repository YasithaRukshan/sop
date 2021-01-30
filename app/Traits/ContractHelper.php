<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait ContractHelper
{

    public function isStaked()
    {
        if(Auth::user()&&Auth::user()->contracts->count()>0){
            return true;
        }
        return false;
    }


}
