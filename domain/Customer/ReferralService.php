<?php

namespace domain\Customer;

use App\Events\PersonalInfoEvent;
use App\Models\Customer;
use App\Models\Image;
use App\Traits\ReferralsHelper;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use infrastructure\Facades\ImageCropperFacade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ReferralService
{
    use ReferralsHelper;
    protected $customers;
    protected $image;

    public function __construct()
    {
        $this->customers = new Customer();
    }
    /**
     * Get Auth Referrals
     *
     * @return Referrals
     */
    public function getAuthReferrals()
    {
        return Auth::user()->referrals;
    }

    /**
     * get by username
     *
     * @return ReferralsID
     */
    public function setFirst()
    {
        $allUsers = Auth::user()->referrals;
        $temp_count = count($allUsers);
        $userId = [];
        $data = [];
        foreach ($allUsers as  $temp_value) {
            array_push($userId,  md5($temp_value['id']));
        }
        $data['count'] = $temp_count;
        if ($temp_count > 0) {
            $data['userId'] = $userId;

            $data['row'] = ' <tr  id="view_row_1"><td>1</td> <td><strong>Direct Referrals</strong></td> <td>' . $data['count'] . '</td> <td>
          <button type="button" class="btn btn-sm btn-primary"
          id="view_details_1" onclick="showFloor(1)">
          Details  </button>  </td> </tr>';
        }
        return $data;
    }
    /**
     * get by auth referral
     *
     * @return ReferralsID
     */
    public function getAuthReferralsID()
    {
        $userId = [];
        $userData = Auth::user()->referrals;
        foreach ($userData as $value) {
            array_push($userId, md5($value['id']));
        }
        return $userId;
    }
    /**
     * Check Next value has referrals
     *
     * @return ReferralsID
     */
    public function checkNext($request)
    {
        $allUsers = $this->customers->all();
        $temp_count = 0;
        foreach ($allUsers as $user) {
            foreach ($request['nowIds'] as $value) {
                if ($value == md5($user['id'])) {
                    $temp_count = $temp_count + count($user->referrals);
                }
            }
        }
        if ($temp_count > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Set new row value
     *
     * @return Data
     */
    public function setNext($request)
    {
        $allUsers = $this->customers->all();
        $temp_count = 0;
        $userId = [];
        foreach ($allUsers as $user) {
            foreach ($request['nowIds'] as $value) {
                if ($value == md5($user['id'])) {
                    if (count($user->referrals) > 0) {
                        $temp_count = $temp_count + count($user->referrals);
                        $userData = $user->referrals;
                        foreach ($userData as  $temp_value) {
                            array_push($userId,  md5($temp_value['id']));
                        }
                    }
                }
            }
        }
        $data['count'] = $temp_count;
        $data['userId'] = $userId;

        $data['row'] = ' <tr  id="view_row_' . $request["level"] . '"><td>' . $request["level"] . '</td><td><strong>Degree ' . (($request["level"] * 1) - 1) . '</strong></td> <td>' . $data['count'] . '</td> <td>
      <button type="button" class="btn btn-sm btn-primary"
      id="view_details_' . $request["level"] . '" onclick="showFloor(' . $request["level"] . ')">
      Details  </button>  </td> </tr>';
        return $data;
    }


    /**
     * Get All Referrals Data
     *
     * @return Data
     */
    public function getAllReferralsData($values, $level)
    {
        $data = [];
        $allUsers = $this->customers->all();
        foreach ($allUsers as $user) {
            foreach ($values as $value) {
                if ($value == md5($user['id'])) {
                    $user['level'] = $level;
                    array_push($data, $user);
                }
            }
        }
        return $data;
    }
    /**
     * Get child Referrals Data
     *
     * @return Customer
     */
    public function childReferralsData($request)
    {
        $allUsers = $this->customers->all();
        foreach ($allUsers as $user) {
            if ($request['id']  == md5($user['id'])) {
                return $user->referrals;
            }
        }
    }

}
