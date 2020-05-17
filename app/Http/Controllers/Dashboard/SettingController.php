<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
     public function social_links()
    {
    	return view('dashboard.settings.social_links');
    }


    public function store(Request $request)
    {
    	setting($request->all())->save();

		toastr()->success('Settings Created Successfully');

		return redirect()->back();	
    }
}
