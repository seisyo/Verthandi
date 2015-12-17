<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Hash;
use Session;

class PasswordController extends Controller
{
    public function show()
    {
        return view('user.password');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:8|max:100',
            'new_password' => 'required|min:8|max:100|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $old_password = User::where('username', '=', Session::get('user'))->first()->password;
        //check old password
        if (Hash::check($request->get('old_password'), $old_password)) {
            User::where('username', '=', Session::get('user'))->first()->update([
                'password' => Hash::make($request->get('new_password'))
            ]);
            Session::flash('toast_message', '成功更新密碼');
            return redirect()->route('password::main');

        } else {
            Session::flash('message', '舊密碼輸入錯誤');
            return redirect()->route('password::main');
        }
    }
}