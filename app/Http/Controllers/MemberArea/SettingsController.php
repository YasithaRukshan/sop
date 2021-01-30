<?php

namespace App\Http\Controllers\MemberArea;

use App\Http\Controllers\Controller;
use App\Traits\FormHelper;
use Illuminate\Http\Request;

class SettingsController extends  ParentController
{
    use FormHelper;

    /**
     * View All Settings
     *
     * @return void
     */
    public function index()
    {
        return view('MemberArea.Pages.Settings.index');
    }
}
