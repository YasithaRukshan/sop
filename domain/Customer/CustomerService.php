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

class CustomerService
{
    use ReferralsHelper;
    protected $customers;
    protected $image;

    public function __construct()
    {
        $this->customers = new Customer();
        $this->image = new Image();
    }

    /**
     * get
     *
     * @param  mixed $id
     * @return void
     */
    function get($id)
    {
        return $this->customers->find($id);
    }

    function getAuthData()
    {
        return $this->customers->find(Auth::user()->id);
    }

    /**
     * getByIds
     *
     * @param  mixed $ids
     * @return void
     */
    function getByIds($ids = [])
    {
        return $ids ? $this->customers->getByIds($ids) : [];
    }

    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        $data = $this->customers->orderBy('id', 'desc')->get();
        return $data;
    }

    /**
     * create
     *
     * @param  mixed $customers
     * @return void
     */
    public function create(array $customers)
    {
        $customersData = $this->customers->create($customers);
        return $customersData;
    }

    /**
     * update
     *
     * @param  mixed $customers
     * @param  mixed $data
     * @return void
     */
    public function update(Customer $customers, array $data)
    {
        if (isset($data['image_id'])) {
            $image = ImageCropperFacade::up($data['image_id'], $data);
            $data['image_id'] = $image['data']->id;
        }
        $customers->update($this->edit($customers, $data));
    }

    /**
     * edit
     *
     * @param  mixed $customers
     * @param  mixed $data
     */
    protected function edit(Customer $customers, $data)
    {
        return array_merge($customers->toArray(), $data);
    }

    /**
     * delete
     *
     * @param  mixed $customers
     * @return void
     */
    public function delete(Customer $customers)
    {
        $customers->delete();
    }
    /**
     * Update Customer Data
     * @param $data
     */
    public function updateData(array $data)
    {
        $response['msg'] = "";
        $this->customers = $this->getAuthData();
        if (isset($data['first_name'])) {
            $this->update($this->customers, $data);
            $response['msg'] = "Your Personal Details Updated Successfully";
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
            $this->update($this->customers, $data);
            $response['msg'] = "Your Password Updated Successfully";
        }
        if (isset($data['image_id'])) {
            $this->update($this->customers, $data);
            $response['msg'] = "Your Profile Image Updated Successfully";
        }
        return $response;
    }

    /**
     * Customer Email Validation
     * @param array $data
     */
    public function ValidateEmail($request)
    {
        $email = $request['email'];
        $data = $this->customers->where('email', $email)->get();
        $data = $data->count();
        if ($data == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
     * Customer User Name Validation
     * @param array $data
     */
    public function ValidateUserName($request)
    {
        $username = $request['username'];
        $data = $this->customers->where('username', $username)->get();
        $data = $data->count();
        if ($data == 0) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
     * Update Customer username
     * @param array $data
     */
    public function updateUsername($request)
    {
        $this->customers = $this->customers->find(Auth::user()->id);
        $this->customers->username = ($request['username']);
        $this->customers->update();
    }

    /**
     * get by username
     *
     * @return Customer
     */
    public function getByUsername($username)
    {
        return $this->customers->getByUsername($username);
    }


    /**
     * check Password
     * @param array $data
     */
    public function checkPassword($data)
    {
        $this->customers = $this->customers->find(Auth::user()->id);
        $value = Hash::check($data['validate_pass'], $this->customers->password);
        if ($value == 1) {
            return 'valid';
        } else {
            return 'invalid';
        }
    }

    /**
     * get by name
     *
     * @return Customer
     */
    public function getName($username)
    {
        if ($username) {
            $data = $this->getByUsername($username);
            $str = 'Joining the Gobal Impact team of ' . $data['first_name'] . ' ' . $data['last_name'] . '   with ID ' . $username;
            $str = wordwrap($str, 70, "<br>\n");
            return  ['text' => $str, 'username' => $username];
        } else {
            $username = config('register.default_referral');
            $data = $this->getByUsername($username);
            $str = 'Joining the Gobal Impact team of ' . $data['first_name'] . ' ' . $data['last_name'] . '   with ID ' . $username;
            $str = wordwrap($str, 70, "<br>\n");
            return  ['text' => $str, 'username' => $username];
        }
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

    /**
     * verifyUser
     *
     * @param  mixed $id
     * @return void
     */
    public function verifyUser($id)
    {
        $this->customers = $this->customers->find($id);
        $this->customers->email_verified_at = Carbon::now();
        return $this->customers->update();
    }
    /**
     * getBySimulate
     *
     * @param  mixed $simulate
     * @return void
     */
    public function getBySimulate($simulate)
    {
        return $this->customers->where('simulate_session', $simulate)->first();
    }
}
