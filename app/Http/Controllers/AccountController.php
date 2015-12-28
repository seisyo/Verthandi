<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Event;

use Session;
use Validator;

class AccountController extends Controller
{
    public function showAccount()
    {
        //make a parent_id array to push to view
        $parentIdList = Account::select('parent_id')->distinct()->get();
        $parentIdArray =[];
        
        foreach ($parentIdList as $parentId) {
            array_push($parentIdArray, $parentId['parent_id']);
        }

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

    public function searchByIdAccount(Request $request)
    {
        $validator = Validator::make(
        [
            'id' => $request->get('id')
        ],
        [
            'id' => 'required|exists:account,id'
        ]);

        if ($validator->fails()) {
            
            $result = ['message' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);

        } else {
            
            if ($request->get('id') % 10000 === 0) {
                
                $gets = Account::where('id', '<' ,$request->get('id') + 10000)->where('id', '>=', $request->get('id'))->get();
                return response()->json(['message' => 'Success', 'content' => $gets]);

            } elseif ($request->get('id') % 1000 === 0) {

                $gets = Account::where('id', '<' ,$request->get('id') + 1000)->where('id', '>=', $request->get('id'))->get();
                return response()->json(['message' => 'Success', 'content' => $gets]);

            } elseif ($request->get('id') % 100 === 0) {

                $gets = Account::where('id', '<' ,$request->get('id') + 100)->where('id', '>=', $request->get('id'))->get();
                return response()->json(['message' => 'Success', 'content' => $gets]);

            } elseif ($request->get('id') % 10 === 0) {

                $gets = Account::where('id', '<' ,$request->get('id') + 10)->where('id', '>=', $request->get('id'))->get();
                return response()->json(['message' => 'Success', 'content' => $gets]);

            } elseif ($request->get('id') % 1 === 0) {

                $gets = Account::where('id', '<' ,$request->get('id') + 1)->where('id', '>=', $request->get('id'))->get();
                return response()->json(['message' => 'Success', 'content' => $gets]);

            } else {
                
                return response()->json(['message' => 'Failed', 'content' => 'Something wrong!']);

            }

            // $arr = str_split(strval($request->get('id')));
            // $length = count($arr);
            // $count = 1;
            
            // foreach ($arr as $value) {
            //     if ($value === '0') {
                    
            //     } else {
            //         $count++;
            //     }            
            // }
        }
    }
}