<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserDetail;
use App\Event;

use Hash;
use Session;
use Mail;
use Validator;
use DB;


class UserController extends Controller
{
    public function showUser()
    {
        return view('user.main')->with(['eventList' => Event::all(), 'userList' => User::all()]);;
    }

    public function addUser(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:user,username|max:100',
            'nickname' => 'required|max:100',
            'last_name' => 'required|max:15',
            'first_name' => 'required|max:15',
            'phone' => 'required|max:15',
            'email' => 'required|e-mail|unique:user_detail,email',
            'permission' => 'required|numeric|max:4|min:1'
        ]);

        //generate default password
        $default_password = str_random(12);
        
        DB::transaction(function() use ($request, $default_password){
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
        });
        
        //send password to user
        $mail = $request->get('email');

        Mail::send('component.confirm_mail', ['password' => $default_password], function($message) use ($mail){
            $message->from(env('MAIL_USERNAME'), 'SITCON財務組');
            $message->to($mail)->subject('SITCON財務系統認證信');
        });

        Session::flash('toast_message', ['type' => 'success', 'content' => '已將密碼認證信寄送至「' . $request->get('email') . '」']);
        return redirect()->route('user::main');
        
    }

    public function editUser(Request $request)
    {   
        if ($request->get('email') === UserDetail::where('user_id', '=', User::find($request->get('id'))->id)->first()->email) {
            $validator = Validator::make(
            [
                'id' => $request->get('id'),
                'nickname' => $request->get('nickname'),
                'last_name' => $request->get('last_name'),
                'first_name' => $request->get('first_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'permission' => $request->get('permission')
            ],
            [
                'id' => 'required|exists:user,id',
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
                'id' => $request->get('id'),
                'nickname' => $request->get('nickname'),
                'last_name' => $request->get('last_name'),
                'first_name' => $request->get('first_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'permission' => $request->get('permission')
            ],
            [
                'id' => 'required|exists:user,id',
                'nickname' => 'required|max:100',
                'last_name' => 'required|max:15',
                'first_name' => 'required|max:15',
                'phone' => 'required|max:15',
                'email' => 'required|e-mail|unique:user_detail,email',
                'permission' => 'required|numeric|max:4|min:1'
            ]);
        }

        if ($validator->fails()) {
            
            $errorname = 'errors' . $request->get('id');
            
            return redirect()->route('user::main')->with($errorname, $validator->messages());
            
        }else{

            DB::transaction(function() use ($request){
                User::find($request->get('id'))->update([
                    'nickname' => $request->get('nickname'),
                    'permission' => $request->get('permission')
                ]);

                UserDetail::where('user_id', '=', User::find($request->get('id'))->id)->update([
                    'last_name' => $request->get('last_name'),
                    'first_name' => $request->get('first_name'),
                    'phone' => $request->get('phone'),
                    'email' => $request->get('email')            
                ]);
            });
           
            Session::flash('toast_message', ['type' => 'success', 'content' => '成功更新使用者「' . User::find($request->get('id'))->username . '」']);
            return redirect()->route('user::main');
        }
        
    }

    public function disableUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:user,id'
        ]);

        User::find($request->get('id'))->update([
            'status' => 'disable'
        ]);

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功停用使用者「' . User::find($request->get('id'))->username . '」']);
        return redirect()->route('user::main');
    }

    public function activateUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:user,id'
        ]);

        User::find($request->get('id'))->update([
            'status' => 'enable'
        ]);

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功啟用使用者「' . User::find($request->get('id'))->username . '」']);
        return redirect()->route('user::main');
    }

    public function deleteUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:user,id'
        ]);

        $deleteName = User::find($request->get('id'))->username;

        DB::transaction(function () use ($request){
            UserDetail::find($request->get('id'))->delete();
            User::find($request->get('id'))->delete();
        });

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除使用者「' . $deleteName . '」']);
        return redirect()->route('user::main');
    }

    public function searchAllUser()
    {
        return response()->json(User::all());
    }

    public function searchByIdUser(Request $request)
    {
        $validator = Validator::make(
        [
            'id' => $request->get('id')
        ],
        [
            'id' => 'required|exists:user,id'
        ]);

        if ($validator->fails()) {

            $result = ['message' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);

        } else {

            $gets = User::find($request->get('id'))->id;
            return response()->json(['message' => 'Success', 'content' => $gets]);
        }
    }
}