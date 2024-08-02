<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(){

        return view('admin.profile.profile');
    }
    public function accountSetting(){

        return view('admin.profile.account_setting');
    }
}
