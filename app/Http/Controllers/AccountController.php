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

        Account::create([
            'id' => $request->get('id'),
            'group' => $request->get('group'),
            'name' => $request->get('name'),
            'direction' => $request->get('direction'),
            'comment' => $request->get('comment')
        ]);

        Session::flash('toast_message', '成功新增會計科目「'.$request->get('name').'」');
        return redirect()->route('account::main');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:45',
            'comment' => 'string'
        ]);

        Account::where('id', '=', $request->get('id'))->first()->update([
            'name' => $request->get('name'),
            'comment' => $request->get('comment')
        ]);

        Session::flash('toast_message', '成功編輯會計科目「'.$request->get('name').'」');
        return redirect()->route('account::main');
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:account,id'
        ]);

        $deleteAccountName = Account::where('id', '=', $request->get('id'))->first()->name;
        Account::where('id', '=', $request->get('id'))->first()->delete();

        Session::flash('toast_message', '成功刪除會計科目「'. $deleteAccountName .'」');
        return redirect()->route('account::main');

    }

    public function search(Request $request)
    {
        $this->validate([
            
        ]);
    }
}