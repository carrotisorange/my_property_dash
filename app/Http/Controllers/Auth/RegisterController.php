<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    protected $redirectTo = '/manager';
    
    // protected $redirectTo = RouteServiceProvider::HOME;
    // protected function authenticated(Request $request, $user)
    // { 
    //     if($user->status === 'unregistered'){
    //         return view('unregistered');
    //     }else{
    //         return redirect('/');
    //     }
    // }

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
            'property' => ['required','unique:users'],
            'property_ownership' => ['required'],
            'property_type' => ['required'],
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
         return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => 'manager',
            'status' => 'registered',
            'property' => $data['property'],
            'account_type' => 'basic',
            'property_ownership' => $data['property_ownership'],
            'property_type' => $data['property_type'],
            'password' => Hash::make($data['password']),
        ]);
    }
}