<?php

namespace App\Traits;

use domain\Facades\CustomerMessagesFacade;

trait MessageHelper
{
    /**
     * Name for Heder Create time
     *
     * @param $created_at
     * @return void
     */
    public function TimeViewName($created_at)
    {
        return  CustomerMessagesFacade::timeViewName($created_at);
    }

    /**
     * Name for Message  View Create time
     *
     * @param $created_at
     * @return void
     */
    public function TimeCrated($created_at)
    {
        return  CustomerMessagesFacade::timeCreated($created_at);
    }

    /**
     * Display Notification Message Count
     *
     * @param  $msg_count
     * @return void
     */
    public function MsgCount($msg_count)
    {
        if ($msg_count > 0) {
            $data = '<i class="bx bx-message-detail"></i>
            <span class="badge badge-danger badge-pill">' . $msg_count . '</span>';
        } else {
            $data = '<i class="bx bx-message-detail"></i>';
        }

        return  $data;
    }
}
