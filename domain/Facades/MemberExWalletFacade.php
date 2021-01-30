<?php

namespace domain\Facades;

use Illuminate\Support\Facades\Facade;

class MemberExWalletFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domain\MainRPC20Services\PersonalWallets\MemberEXWalletsServices';
    }
}
