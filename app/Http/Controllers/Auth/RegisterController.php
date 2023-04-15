<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/added';

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
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'username' => 'required|string|min:4|max:12',
                    'mail' => 'required|email|min:4|unique:users,mail',
                    'password' => 'required|min:4|max:12|confirmed',
                    'password_confirmation' => 'required|min:4|max:12',
                ],
                [
                    'required' => 'この項目は必須です。',
                    'min' => '４文字以上入力が必要です。',
                    'max' => '１２文字以内で入力して下さい。',
                    'unique' => 'すでに使用されているメールアドレスです。',
                    'confirmed' => 'パスワードが一致しません。',
                ]
            );
            $data = $request->input();
            $this->create($data);
            $username = $request->input('username');
            return view("auth.added", compact('username'));
        }
        return view("auth.register");
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
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


}
