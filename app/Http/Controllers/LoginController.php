<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;

use Hash;
use Session;

class LoginController extends Controller
{
    public function check()
    {
        if (Session::get('check')) {    
            return redirect()->route('index');
        } else {
            return view('user.login');
        }
    }

    public function showIndex()
    {
        return view('index')->with(['eventList' => Event::all()]);
    } 

    public function login(Request $request)
    { 
        $this->validate($request,[
            'username' => 'required|max:100|exists:user,username',
            'password' => 'required|min:8|max:100'
        ]);
        
        $userInfo = User::where('username', '=', $request->get('username'))->first();
        $password = $userInfo->password;

        if (Hash::check($request->get('password'), $password)) {
            if ($userInfo->status === 'enable' || $userInfo->status === 'admin') {
                Session::put('user', $userInfo);
            
                return redirect()->route('index');
            } else {
                Session::flash('message', ['content' => '非合法使用者']);
            
                return redirect()->route('login::main');
            }
        } else {
            Session::flash('message', ['content' => '密碼錯誤']);
            
            return redirect()->route('login::main');
        }
    }


    public function logout()
    {
        Session::flush(); 
        return redirect()->route('login::main');
    }
}