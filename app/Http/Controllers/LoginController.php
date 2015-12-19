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
            dd(1);
            return redirect()->route('index', ['username' => 'admin']);
        } else {
            dd(2);
            return view('user.login');
        }
        
    }

    public function login(Request $request)
    { 
        $this->validate($request,[
            'username' => 'required|max:100|exists:user,username',
            'password' => 'required|min:8|max:100'
        ]);

        // put all login user's data to the Session 'user'
        $user = User::where('username', '=', $request->get('username'))->first();
        $password = $user->password;


        if (Hash::check($request->get('password'), $password)) {
            Session::put('user', $user);
            
            return redirect()->route('index', ['username' => 'admin']);
        } else {
            Session::flash('message', '密碼錯誤');
            
            return redirect()->route('login::main');
        }
    }


    public function logout()
    {
        Session::flush();
        return redirect()->route('login::main');
    }
}