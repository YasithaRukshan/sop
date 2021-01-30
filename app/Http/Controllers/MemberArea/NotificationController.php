<?php

namespace App\Http\Controllers\MemberArea;

use App\Http\Controllers\Controller;
use domain\Facades\NotificationFacade;
use Illuminate\Http\Request;

class NotificationController extends ParentController
{
    public function index($paginate_number)
    {
        $response['notifications'] = NotificationFacade::getPaginateNotification($paginate_number);
        $response['paginate_number'] = $paginate_number;

        return view('Pages.notification.notification')->with($response);
    }

    public function getNotificationDetailsByDate(Request $request)
    {
        $response['notifications'] = NotificationFacade::getNotificationDetailsByDate($request);
        return view('Pages.notification.notificationCard')->with($response);
    }
}
