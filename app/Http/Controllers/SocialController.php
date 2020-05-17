<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;

class SocialController extends Controller
{
    
	public function redirect($service)
	{
		
		return Socialite::driver($service)->redirect();
	}

	public function callback($service)
	{
		$userSocial  = Socialite::with($service)->user();
// dd($userSocial);
		$findUser = User::where('email', $userSocial->email)->first();

		if($findUser)
		{
			Auth::login($findUser);

			return redirect('/');
		}else{

		$user = new User;

		$user->name = $userSocial->name;
		$user->email = $userSocial->email;
		$user->save(); 

		Auth::login($user);

			return redirect('/');
		}
		

	}


}
