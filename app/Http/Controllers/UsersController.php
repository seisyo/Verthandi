<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Users_detail;

use Hash;
use Session;
use Mail;

class UsersController extends Controller
{
    public function show()
    {
        return view('/users_overview')->with('userList', Users::all());
    }

    public function addUser(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:users,username|max:100',
            'nickname' => 'required|max:100',
            'last_name' => 'required|max:15',
            'first_name' => 'required|max:15',
            'phone' => 'required|max:15',
            'email' => 'required|e-mail',
            'permission' => 'required|numeric|max:4|min:1'
        ]);

        //generate default password
        $default_password = str_random(12);
        
        //add new user to users table
        Users::create([
            'username' => $request->get('username'),
            'password' => Hash::make($default_password),
            'nickname' => $request->get('nickname'),
            'status' => 'enable',
            'permission' => $request->get('permission')
        ]);
        
        //add user detail info to users_detail table
        Users_detail::create([
            'user_id' => Users::where('username', '=', $request->get('username'))->first()->id,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone')
        ]);

        //將密碼寄信給使用者
        $mail = $request->get('email');
        Mail::send('component.confirm_mail', ['password' => $default_password], function($message) use ($mail){
            $message->from(env('MAIL_USERNAME'), 'SITCON財務組');
            $message->to($mail)->subject('SITCON財務系統認證信');
        });

        Session::flash('message', '已將密碼認證信寄送至'.$request->get('email'));
        return redirect('/user');
        
    }

    public function editUser(Request $request)
    {
        echo('hello!');
    }

    public function deleteUser(Request $request)
    {

    }
}