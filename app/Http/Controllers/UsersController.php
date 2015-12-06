<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Users_detail;

use Hash;
use Session;

class UsersController extends Controller{

    public function adduser(Request $request){

        $this->validate($request,
        [
            'username' => 'required|unique:users,username|max:100',
            'nickname' => 'required|max:100',
            'last_name' => 'required|max:15',
            'first_name' => 'required|max:15',
            'phone' => 'required|max:15',
            'email' => 'required|e-mail',
            'permission' => 'required|numeric|max:4|min:1'
        ]);

        //產生預設密碼
        $default_password = str_random(12);
        
        //將新使用者新增至users
        $get1 = Users::create(
        [
            'username' => $request->get('username'),
            'password' => Hash::make($default_password),
            'nickname' => $request->get('nickname'),
            'status' => 'unverified',
            'permission' => $request->get('permission')
        ]);
        
        //將使用者詳細資訊放入users_detal
        $get2 = Users_detail::create(
        [
            'user_id' => Users::where('username', '=', $request->get('username'))->first()->id,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone')
        ]);

        //將密碼寄信給使用者

        

        
    }

    public function edituser(Request $request){

    }

    public function deleteuser(Request $request){

    }
}