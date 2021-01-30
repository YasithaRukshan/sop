<?php

namespace App\Http\Controllers;

use domain\Facades\ContactFacade;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * View Public Index
     *
     * @return void
     */
    public function index()
    {
        return view('PublicArea.Pages.ContactUs.index');
    }

    /**
     * store Public Index
     *
     * @return void
     */
    public function store(Request $request)
    {
        ContactFacade::create($request->all());
        $response['alert-success'] = 'Customer Contact Us Created Successfully';
        return redirect()->route('/')->with($response);
    }
}
