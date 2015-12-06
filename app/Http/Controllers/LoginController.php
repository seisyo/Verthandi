<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;

use Hash;
use Session;

class LoginController extends Controller{

    public function login(Request $request){
        
        $this->validate($request,[

            'username' => 'required|max:100|exists:users,username',
            'password' => 'required|min:8|max:100'
        ]);

        $password = Users::where('username', '=', $request->get('username'))->first()->password;

        if(Hash::check($request->get('password'), $password)){
            
            Session::put('check', true);
            return redirect('/');

        }else{
            
            Session::flash('message', '密碼錯誤');
            return redirect('/login');

        }
    }

    public function logout(){

        Session::flush();
        return redirect('/login');

    }
}