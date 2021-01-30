<?php


namespace domain\Notification;

use App\Models\Notification;
use App\User;
use Carbon\Carbon;
use domain\Facade\UserFacade;
use Illuminate\Support\Facades\Auth;

class NotificationService
{
    protected $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }

    public function sendNotification($data)
    {
        return $this->notification->create($data);
    }

    public function sendCustomerNotification($data)
    {
        return $this->customer_notification->create($data);
    }

    public function readNotification($id)
    {
        $this->notification = Notification::find($id);

        $this->notification->read = true;
        $this->notification->update();
    }

    public function getNotification($id)
    {
        return $this->notification->find($id);
    }

    
    public function getNotificationDetailsByDate($data)
    {
        $date = Carbon::parse($data['date'])->format('Y-m-d');
        return $this->notification
            ->whereDate('created_at',$date)
            ->get();
    }

    public function getPaginateNotification($paginate_number)
    {
        $messages = $this->notification->all();
        foreach ($messages as $msg) {
            if ($msg->read == 0) {
                $msg->read = 1;
                $msg->save();
            }
        }

        return $this->notification
            ->orderBy('created_at', 'desc')
            ->paginate($paginate_number);
    }

    public function totalCountOfNotification(){

        return $this->notification->totalCountOfNotification();

    }

    public function newNotification(){

        return $this->notification->newNotification();

    }


}
