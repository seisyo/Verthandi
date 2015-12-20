<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserDetail;

use Hash;
use Session;
use Mail;
use Validator;


class UserController extends Controller
{
    public function show()
    {
        return view('user.main')->with('userList', User::all());
    }

    public function addUser(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:user,username|max:100',
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
        User::create([
            'username' => $request->get('username'),
            'password' => Hash::make($default_password),
            'nickname' => $request->get('nickname'),
            'status' => 'enable',
            'permission' => $request->get('permission')
        ]);
        
        //add user detail info to users_detail table
        UserDetail::create([
            'user_id' => User::where('username', '=', $request->get('username'))->first()->id,
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

        Session::flash('toast_message', '已將密碼認證信寄送至「'.$request->get('email').'」');
        return redirect()->route('user::main');
        
    }

    public function editUser(Request $request)
    {
        if ($request->get('email') === UserDetail::where('user_id', '=', User::where('username', '=', $request->get('username'))->first()->id)->first()->email) {
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
                'username' => 'required|exists:user,username',
                'nickname' => 'required|max:100',
                'last_name' => 'required|max:15',
                'first_name' => 'required|max:15',
                'phone' => 'required|max:15',
                'email' => 'required|e-mail',
                'permission' => 'required|numeric|max:4|min:1'
            ]);
        } else {
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
                'username' => 'required|exists:user,username',
                'nickname' => 'required|max:100',
                'last_name' => 'required|max:15',
                'first_name' => 'required|max:15',
                'phone' => 'required|max:15',
                'email' => 'required|e-mail|unique:user_detail,email',
                'permission' => 'required|numeric|max:4|min:1'
            ]);
        }

        if ($validator->fails()) {
            $errorname = 'errors' . User::where('username', '=', $request->get('username'))->first()->id;
            return redirect()->route('user::main')->with($errorname, $validator->messages());
        }else{

            User::where('username', '=', $request->get('username'))->first()->update([
                'nickname' => $request->get('nickname'),
                'permission' => $request->get('permission')
                ]);

            UserDetail::where('user_id', '=', User::where('username', '=', $request->get('username'))->first()->id)->update([
                'last_name' => $request->get('last_name'),
                'first_name' => $request->get('first_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),            
                ]);

            Session::flash('toast_message', '成功更新「'.$request->get('username').'」的資料');
            return redirect()->route('user::main');
        }
        
    }

    public function deleteUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:user'
        ]);

        User::where('username', '=', $request->get('username'))->first()->update([
            'status' => 'disable'
        ]);

        Session::flash('toast_message', '成功刪除使用者「'.$request->get('username').'」');
        return redirect()->route('user::main');
    }
}