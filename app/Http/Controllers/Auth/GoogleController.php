<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;
use Session;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        $scopes = [
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/userinfo.profile'
        ];   
        //return Socialite::driver('google')->redirect();
        return Socialite::driver('google')->scopes($scopes)->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $gUser = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect()->to('login')->with('status', ''.$e);
        }

        
            $existUser =User::where('email',$gUser->getEmail())
                ->where('appsname', '=', 'WEB-ENS')
                ->first();
            session()->put('googleid', $gUser->getId());
            session()->put('profilepic', $gUser->getAvatar());

            if ($existUser)
            {
                Auth::loginUsingId($existUser->id);
                
                return redirect()->route('home');
            }else{
                return redirect()->to('login')->with('status', 'You are not registered on this application, Please contact your system administrator');
            } 
        
    }
}
