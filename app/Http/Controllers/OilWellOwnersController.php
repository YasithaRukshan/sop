<?php

namespace App\Http\Controllers;

use domain\Facades\OwnerContactFacades;
use Illuminate\Http\Request;

class OilWellOwnersController extends Controller
{
    /**
     * View Public Index
     *
     * @return void
     */
    public function index()
    {
        return view('PublicArea.Pages.OilWellOwners.index');
    }

    /**
     * store Public Index
     *
     * @return void
     */
    public function store(Request $request)
    {
        OwnerContactFacades::store($request->all());
        $response['alert-success'] = 'Customer Created Successfully';
        return redirect()->route('/')->with($response);
    }
}
