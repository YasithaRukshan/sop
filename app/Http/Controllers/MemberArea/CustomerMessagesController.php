<?php

namespace App\Http\Controllers\MemberArea;


use Illuminate\Http\Request;
use App\Traits\FormHelper;
use App\Traits\MessageHelper;
use domain\Facades\CustomerMessagesFacade;

class CustomerMessagesController extends  ParentController
{
    use FormHelper;
    use MessageHelper;

    /**
     * View All Auth Messages
     *
     * @return void
     */
    public function index()
    {
        $response['messages'] = CustomerMessagesFacade::getByAuth();
        $response['tc'] = $this;
        return view('MemberArea.Pages.Messages.all')->with($response);
    }

    /**
     * View Messages(For AJAX Loader)
     *
     * @return void
     */
    public function view()
    {
        $response['messages'] = CustomerMessagesFacade::getByAuth();
        $response['tc'] = $this;
        return view('MemberArea.Pages.Messages.Components.single')->with($response);
    }

    /**
     * Store Message
     *
     * @return void
     */

    public function store(Request $request)
    {
        CustomerMessagesFacade::store($request);
    }

    /**
     * Read The Auth Messages
     *
     * @return void
     */

    public function read()
    {
        CustomerMessagesFacade::read();
    }

    /**
     * Delete Selected Message
     *
     * @return void
     */

    public function delete(Request $request)
    {
        CustomerMessagesFacade::delete($request);
    }

    /**
     * Display The Notification
     *
     * @return void
     */
    public function notification()
    {
        $response['messages'] = CustomerMessagesFacade::notification();
        $response['msg_count'] = count($response['messages']);
        $response['tc'] = $this;
        return view('MemberArea.Pages.Messages.Components.notification')->with($response);
    }

    /**
     * Trigger Pusher
     *
     * @return void
     */
    public function pusher()
    {
        CustomerMessagesFacade::pusherData();
    }
}
