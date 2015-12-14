<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;

use Session;

class AccountController extends Controller
{
    public function show()
    {
        return view('account.main')->with('accountList', Account::all());
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:account,id|numeric|max:99999|min:10000',
            'group' => 'required|in:資產, 負債, 餘絀, 收益, 費損',
            'name' => 'required|max:45',
            'direction' => 'required|in:借, 貸',
            'comment' => 'string'
        ]);

        //dd(intval($request->get('id')));

        Account::create([
            'id' => intval($request->get('id')),
            'group' => $request->get('group'),
            'name' => $request->get('name'),
            'direction' => $request->get('direction'),
            'comment' => $request->get('comment')
        ]);

        Session::flash('toast_message', '成功新增會計科目「'.$request->get('name').'」');
        return redirect(route('account::main'));
    }
}