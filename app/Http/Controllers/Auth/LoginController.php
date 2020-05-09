<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     public function redirectToProvider($provider)
    {
        config([
            'services. '.$provider.' .facebook.client_id' => setting($provider .'_client_id'),
            'services. '.$provider.' .client_secret' => setting($provider .'_client_secret'),
            'services. '.$provider.' .facebook.redirect_url' => setting($provider .'_redirect_url')

        ]);

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

        try {

        $social_user = Socialite::driver($provider)->user();

            
        } catch (Exception $e) {

            return redirect('/');
            
        }
        
        $user = User::where('provider',$provider)
        ->where($provider->id, $social_user->getId())->first();


        if(!$user)
        {
            $userCreation = User::create([

                'name' => $social_user->getName(),
                'email' => $social_user->getEmail(),
                'provider' =>$provider,
                'provider_id' => $social_user->getId(),


            ]);

            $userCreation->attachRole('user');
        }


        Auth::login($userCreation, true);

        return redirect()->intended('/');
    }
}
