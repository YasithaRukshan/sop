<?php

/**
 * Author: Spera Labs/(+94)112 144 533
 * Email: hello@speralabs.com
 * File Name: DataManagementFacade.php
 * Copyright: Any unauthorized broadcasting, public performance, copying or re-recording will constitute an infringement of copyright.
 */

namespace domain\Messages;

use App\Models\Customer;
use App\Models\CustomerMessages;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

/**
 * Class DataManagementService
 * @user domain\Video
 */
class CustomerMessagesService
{
    protected $customerMessage;
    protected $customer;
    protected $user_id;

    public function __construct()
    {
        $this->customerMessage = new CustomerMessages();
        $this->customer = new Customer();
        $this->user_id = Auth::user()->id;
    }

    /**
     * Get Auth Messages Only
     */
    public function getByAuth()
    {
        return $this->customerMessage->where('user_id', $this->user_id)->orderBy('id', 'ASC')->get();
    }

    /**
     * Create Message
     * @param  $request
     */
    public function store($request)
    {
        $userData = $this->customer->find($this->user_id);
        $message = $request['message'];
        $data['user_id'] = $this->user_id;
        $data['message'] = $message;
        $data['from_who'] = '0';
        $data['message_read'] = '0';
        $this->customerMessage->create($data);
        $this->resolved();
    }

    /**
     * Delete a Message
     * @param $request
     */
    public function delete($request)
    {
        $this->customerMessage = $this->customerMessage->find($request['id']);
        $this->customerMessage->delete();
    }

    /**
     * Auth User Message Resolved
     */
    public function resolved()
    {
        return $this->customer->where('id', $this->user_id)->update(array('chat_resolved' => 0));
    }

    /**
     * Get Auth User Messages For Notification
     */
    public function notification()
    {
        return $this->customerMessage
            ->where('user_id', $this->user_id)
            ->where('from_who', '1')
            ->where('message_read', '0')
            ->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Read Auth User Messages
     */
    public function read()
    {
        $cus_msg = $this->getByAuth();
        if ($cus_msg->count() > 0) {
            return $this->customerMessage->where('user_id',  $this->user_id)
                ->where('from_who', '1')
                ->update(array('message_read' => 1));
        }
    }

    /**
     * Trigger pusher With Data
     */
    public function pusherData()
    {
        $userData = $this->customer->find($this->user_id);
        $data['user_id'] = $this->user_id;
        $data['from_who'] = '0';
        $data['user_type'] = 'cus';
        $data['first_name'] = $userData['first_name'];
        $data['last_name'] = $userData['last_name'];

        // pusher
        $options = config("broadcasting.connections.pusher.options");

        $pusher = new Pusher(
            config("broadcasting.connections.pusher.key"),
            config("broadcasting.connections.pusher.secret"),
            config("broadcasting.connections.pusher.app_id"),
            $options
        );
        $data['from'] = Auth::id();
        $data['to'] = '0';

        $pusher->trigger('my-channel', 'my-event', $data);
    }

    /**
     * Get Name Using Time
     * @param $date
     */
    public function timeViewName($date)
    {
        $nowTime = Carbon::now();
        $difference = ($nowTime->diff($date)->days < 1);
        if ($difference == 1) {
            return 'Today';
        } else {
            $difference = ($nowTime->diff($date)->days < 2);
            if ($difference == 1) {
                return 'Yesterday';
            } else {
                $diff_in_year = $nowTime->diffInYears($date);
                if ($diff_in_year < 1) {
                    $name = Carbon::parse($date)->format('M d');
                    return $name;
                } else {
                    $name = Carbon::parse($date)->format('Y M d');
                    return $name;
                }
            }
        }
    }

    /**
     *  Name For Create Time
     * @param $date
     */
    public function timeCreated($date)
    {
        $nowTime = Carbon::now();
        $difference = ($nowTime->diff($date)->days < 1);
        if ($difference == 1) {
            $name = Carbon::parse($date)->format('h:i A') . ' | Today';
            return  $name;
        } else {
            $difference = ($nowTime->diff($date)->days < 2);
            if ($difference == 1) {
                $name = Carbon::parse($date)->format('h:i A') . ' | Yesterday';
                return  $name;
            } else {
                $diff_in_year = $nowTime->diffInYears($date);
                if ($diff_in_year < 1) {
                    $name = Carbon::parse($date)->format('h:i A') . ' | ' . Carbon::parse($date)->format('M d');
                    return  $name;
                } else {
                    $name = Carbon::parse($date)->format('h:i A') . ' | ' . Carbon::parse($date)->format('Y M d');
                    return  $name;
                }
            }
        }
    }
}
