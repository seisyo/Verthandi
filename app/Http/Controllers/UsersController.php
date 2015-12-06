<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        echo("sucess!!");
    }

    public function edituser(Request $request){

    }

    public function deleteuser(Request $request){

    }
}