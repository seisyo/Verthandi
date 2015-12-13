<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Hash;
use Session;

class LoginController extends Controller
{
    public function check()
    {
        if (Session::get('check')) {    
            return redirect(route('index', ['username' => Session::get('user')]));
        } else {
            return view('user.login');
        }
    }

    public function login(Request $request)
    { 
        $this->validate($request,[
            'username' => 'required|max:100|exists:user,username',
            'password' => 'required|min:8|max:100'
        ]);

        $password = User::where('username', '=', $request->get('username'))->first()->password;


        if (Hash::check($request->get('password'), $password)) {
            Session::put('check', true);
            Session::put('user', $request->get('username'));
            $user = User::all();
            return redirect(route('index', ['username' => Session::get('user')]));
        } else {
            Session::flash('message', '密碼錯誤');
            return redirect(route('login::main'));
        }
    }


    public function logout()
    {
        Session::flush();
        return redirect(route('login::main'));
    }
}