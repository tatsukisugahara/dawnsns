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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'between:4,12'],
            'mailadress' => ['required', 'between:4,12', 'unique:users'],
            'password' => ['required', 'alpha_num', 'between:4,12'],
            'password-confirm' => ['required', 'alpha_num', 'between4,12', 'same:password'],
        ], [
                'username.required' => '入力必須',
                'username.between' => '4文字以上、12文字以内',
                'mailadress.required' => '入力必須',
                'mailadress.between' => '4文字以上、12文字以内',
                'mailadress.unique' => '登録済みアドレス使用不可',
                'password.required' => '必須項目です',
                'password.alpha_num' => '英数字のみ',
                'password.between' => '4文字以上、12文字以内',
                'password-confirm.required' => '必須項目です',
                'password-confirm.alpha_num' => '英数字のみ',
                'password-confirm.min' => '4文字以上、12文字以内',
                'password-confirm.same:password' => 'Password入力欄と一致必須'
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
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();

            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
