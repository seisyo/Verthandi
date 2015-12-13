<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;

class AccountController extends Controller
{
    public function show()
    {
        return view('account.main')->with('accountList', Account::all());
    }
}