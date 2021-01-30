<?php

namespace domain\OwnerContactServices;

use App\Models\OwnerContact;

/**
 * Created by PhpStorm.
 * User: Speralabs
 * Date: 10/07/2020
 * Time: 02:10 PM
 */
class OwnerContactServices
{
    protected $ownerContact;


    public function __construct()
    {
        $this->ownerContact = new OwnerContact();
    }


    /**
     * Create Owner Contact
     * @param  $request
     */
    public function store($request)
    {
        if (isset($request['status']) && isset($request['status2'])) {
            $request['status']=$request['status']+$request['status2'];
            unset($request['status2']);
            $this->ownerContact->create($request);
        } elseif (isset($request['status2'])) {
            $request['status'] = 2;
            unset($request['status2']);
            $this->ownerContact->create($request);
        } else {
            $this->ownerContact->create($request);
        }
    }
}
