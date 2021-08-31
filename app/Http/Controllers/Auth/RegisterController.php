<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $pin = mt_rand(1000000, 9999999)
        //     . mt_rand(1000000, 9999999)
        //     . $characters[rand(0, strlen($characters) - 1)];
        return User::create([
            'id' => rand(1, 11),
            'name' => $data['name'],
            'email' => $data['email'],
            // 'mobile_phone' => $data['mobile_phone'],
            // 'departement' => $data['departement'],
            // 'cluster_id' => $data['cluster_id'],
            // 'employe_id' => str_shuffle($pin),
            'password' => Hash::make($data['password']),
        ]);
    }
}
