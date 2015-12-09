<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Users_detail;

use Hash;
use Session;
use Mail;
use Validator;


class UserController extends Controller
{
    public function show()
    {
        return view('users_overview')->with('userList', Users::all());
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

        //send password to user
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
        $validator = Validator::make(
        [
            'username' => $request->get('username'),
            'nickname' => $request->get('nickname'),
            'last_name' => $request->get('last_name'),
            'first_name' => $request->get('first_name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'permission' => $request->get('permission')
        ],
        [
            'username' => 'required|exists:users',
            'nickname' => 'required|max:100',
            'last_name' => 'required|max:15',
            'first_name' => 'required|max:15',
            'phone' => 'required|max:15',
            'email' => 'required|e-mail',
            'permission' => 'required|numeric|max:4|min:1'
        ]);

        if ($validator->fails()) {
            $errorname = 'errors'.Users::where('username', '=', $request->get('username'))->first()->id;
            return redirect('/user')->with($errorname, $validator->messages());
        }else{
            echo('success!');
        }
        
        Users::where('username', '=', $request->get('username'))->first()->update([
            'nickname' => $request->get('nickname'),
            'permission' => $request->get('permission')
        ]);

        Users_detail::where('user_id', '=', Users::where('username', '=', $request->get('username'))->first()->id)->update([
            'last_name' => $request->get('last_name'),
            'first_name' => $request->get('first_name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),            
        ]);

        Session::flash('message', '已更新'.$request->get('username').'的資料');
        return redirect('/user');
    }

    public function deleteUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:users'
        ]);

        Users::where('username', '=', $request->get('username'))->first()->update([
            'status' => 'disable'
        ]);

        Session::flash('message', '已刪除'.$request->get('username'));
        return redirect('/user');
    }
}