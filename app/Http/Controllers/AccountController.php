<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Event;

use Session;
use Validator;
use DB;

class AccountController extends Controller
{
    public function showAccount()
    {
        //make a parent_id array to push to view
        $parentIdArray = DB::select('select cast(concat(parent_id,id) as INTEGER) as parentable_id,name from account where length(cast(concat(parent_id,id) as INTEGER)) < 5 and id != 0');
        //dd($parentIdArray);
        return view('account.main')->with(['accountList' => Account::all(), 'parentList' => $parentIdArray, 'eventList' => Event::all()]);
    }

    public function addAccount(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:account,id|numeric|max:99999|min:10000',
            'name' => 'required|max:45',
            'parent_id' => 'exists:account,id',
            'direction' => 'required|boolean',
            'comment' => 'string'
        ]);

        Account::create([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id'),
            'direction' => $request->get('direction'),
            'comment' => $request->get('comment')
        ]);

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增會計科目「' . $request->get('name') . '」']);
        
        return redirect()->route('account::main');
    }

    public function editAccount(Request $request)
    {
        $validator = Validator::make(
        [   
            'name' => $request->get('name'),
            'comment' => $request->get('comment')
        ],
        [
            'name' => 'required|max:45',
            'comment' => 'string'
        ]);

        if ($validator->fails()) {
            
            $errorname = 'errors' . $request->get('id');
            
            return redirect()->route('account::main')->with($errorname, $validator->messages());

        }

        Account::where('id', '=', $request->get('id'))->first()->update([
            'name' => $request->get('name'),
            'comment' => $request->get('comment')
        ]);

        Session::flash('toast_message', ['type' => 'success', 'content'=> '成功編輯會計科目「' . $request->get('name') . '」']);
         
        return redirect()->route('account::main');
    }

    public function deleteAccount(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:account,id'
        ]);

        $deleteAccountName = Account::where('id', '=', $request->get('id'))->first()->name;
        Account::where('id', '=', $request->get('id'))->first()->delete();

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除會計科目「' . $deleteAccountName . '」']);
        
        return redirect()->route('account::main');

    }

    public function searchAllAccount()
    {
        return response()->json(Account::all());
    }

    public function searchNextIdByParentId(Request $request)
    {
        $validator = Validator::make(
        [
            'parent_id' => $request->get('parent_id')
        ],
        [
            'parent_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            
            $result = ['type' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);

        } else {

            $result = DB::select('select max(id)+1 as useable_id from account where cast(parent_id  as INTEGER) = ?', [$request->get('parent_id')]);
            if ($result[0]->useable_id === null) {
                return response()->json(['type' => 'Success', 'content' => 1]);
            } else {
                return response()->json(['type' => 'Success', 'content' => $result[0]->useable_id]);
            }
            
        }

    }

    public function searchByIdAccount(Request $request)
    {
        $id = substr($request->get('id'), strlen($request->get('id'))-1);
        $parent_id = substr($request->get('id'), 0, strlen($request->get('id')) - 1);
        
        $validator = Validator::make(
        [
            'id' => $id,
            'parent_id' => $parent_id
        ],
        [
            'id' => 'required|exists:account,id',
            'parent_id' => 'required|exists:account,parent_id'
        ]);

        if ($validator->fails()) {
            
            $result = ['type' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);

        } else {

            // start account id
            $startId = (int)(str_pad((int)$request->get('id'), 5, '0', STR_PAD_RIGHT));
            // end account id
            $endId = (int)(str_pad((int)$request->get('id') + 1, 5, '0', STR_PAD_RIGHT));            
            // create view full_id as (select *,RPAD(cast(concat(parent_id,id) as INTEGER),5,'0') as full_id from account);
            // full_id is a view. 
            $result = DB::select('select concat(parent_id,id) as id from full_id where full_id >= cast(:head as INTEGER) and full_id < cast(:tail as INTEGER)', ['head' => $startId, 'tail' => $endId]);

            return response()->json(['type' => 'Success', 'content' => $result]);
        }
    }
}