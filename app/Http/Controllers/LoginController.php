<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;

use Validator;

class LoginController extends Controller{

    public function login(Request $request){
        
        $this->validate($request,[

            'username' => 'required|max:100|exists:users,username',
            'password' => 'required|min:8|max:100'
        ]);

        
    }
}