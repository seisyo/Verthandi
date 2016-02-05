<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;

use Hash;
use Session;

class PasswordController extends Controller
{
    public function show()
    {
        return view('user.password')->with(['eventList' => Event::all()]);;
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8|max:100',
            'new_password' => 'required|min:8|max:100|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $old_password = User::where('id', '=', Session::get('user')->id)->first()->password;
        //check old password
        if (Hash::check($request->get('old_password'), $old_password)) {
            
            $result = User::where('id', '=', Session::get('user')->id)->first()->update([
                'password' => Hash::make($request->get('new_password'))
            ]);
            
            if ($result) {
                Session::flash('toast_message', ['type' => 'success' ,'content' => '成功更新密碼']);
                return redirect()->route('password::main');
            } else {
                Session::flash('toast_message', ['type' => 'error' ,'content' => '更新密碼失敗']);
                return redirect()->route('password::main');
            }
            
        } else {
            Session::flash('message', ['content' => '舊密碼輸入錯誤']);
            return redirect()->route('password::main');
        }
    }
}