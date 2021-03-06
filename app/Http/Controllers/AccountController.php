<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Account;
use App\Event;
use App\Diary;

use Session;
use Validator;
use DB;
use Cache;

class AccountController extends Controller
{
    public function showAccount()
    {
        //make a parent_id array to push to view
        $parentIdArray = DB::select('select cast(concat(parent_id,id) as UNSIGNED) as parentable_id,name from account where length(cast(concat(parent_id,id) as UNSIGNED)) < 5 and id != 0');

        return view('account.main')->with(['accountList' => Account::all(), 'parentList' => $parentIdArray, 'eventList' => Event::all()]);
    }

    public function addAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:45',
            'parent_id' => 'required|numeric',
            'direction' => 'required|boolean',
            'comment' => 'string'
        ]);
        $request->flash();
        
        $id = DB::select('select max(id)+1 as useable_id from account where cast(parent_id  as UNSIGNED) = ?', [$request->get('parent_id')])[0]->useable_id;
        // if $id return null, it presents this parent does't have child account, so return 1 
        
        if ($id === null) {
            $id = 1;
        } 

        if ($id > 9) {
            
            Session::flash('toast_message', ['type' => 'warning', 'content' => '無法再新增子科目於此父科目']);
            return redirect()->route('account::main');

        } else {
            
            $result = DB::table('account')->insert([
                'id' => $id,
                'name' => $request->get('name'),
                'parent_id' => $request->get('parent_id'),
                'direction' => $request->get('direction'),
                'comment' => $request->get('comment')
            ]);

            if ($result) {
                Cache::forget('accountList');
                Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增會計科目「' . $request->get('name') . '」']);
                return redirect()->route('account::main');
            } else {
                Session::flash('toast_message', ['type' => 'error', 'content' => '新增會計科目「' . $request->get('name') . '」失敗']);
                return redirect()->route('account::main');
            }
        }
    }

    public function editAccount(Request $request)
    {
        $validator = Validator::make(
        [   
            'id' => $request->get('id'),
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
            'comment' => $request->get('comment')
        ],
        [
            'id' => 'required|exists:account,id',
            'parent_id' => 'required|exists:account,parent_id',
            'name' => 'required|max:45',
            'comment' => 'string'
        ]);

        if ($validator->fails()) {
            $errorname = 'errors' . $request->get('parent_id') . $request->get('id');
            return redirect()->route('account::main')->with($errorname, $validator->messages());

        } else {
            
            $result = DB::table('account')->where('id', '=', $request->get('id'))->where('parent_id', '=', $request->get('parent_id'))->update([
                'name' => $request->get('name'),
                'comment' => $request->get('comment')
            ]);

            if ($result) {
                Cache::forget('accountList');
                Session::flash('toast_message', ['type' => 'success', 'content'=> '成功編輯會計科目「' . $request->get('name') . '」']);
                return redirect()->route('account::main');
            } else {
                Session::flash('toast_message', ['type' => 'error', 'content'=> '編輯會計科目「' . $request->get('name') . '」失敗']);
                return redirect()->route('account::main');
            }
        }
    }

    public function deleteAccount(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:account,id',
            'parent_id' => 'required|exists:account,parent_id'
        ]);

        // Check the account whether has the pareant
        $checkParent = Account::where('parent_id', '=', $request->get('parent_id') . $request->get('id'))->first();
        // Save the account name
        $query = DB::table('account')->where('id', '=', $request->get('id'))->where('parent_id', '=', $request->get('parent_id'));
        $deleteAccountName = $query->get()[0]->name;
        if ($checkParent === null) {
            // Check the account whether be used in Diary
            $checkDiary = DB::select('select * from diary where account_id = :accountId and account_parent_id = :accountParentId',['accountId' => $request->get('id'), 'accountParentId' => $request->get('parent_id')]);

            if (empty($checkDiary)) {
                $result = $query->delete();
                
                if ($result) {
                    Cache::forget('accountList');
                    Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除會計科目「' . $deleteAccountName . '」']);
                    return redirect()->route('account::main');
                } else {
                    Session::flash('toast_message', ['type' => 'error', 'content' => '刪除會計科目「' . $deleteAccountName . '」失敗']);
                    return redirect()->route('account::main');
                }
            } else {
                Session::flash('toast_message', ['type' => 'warning', 'content' => '刪除會計科目「' . $deleteAccountName . '」失敗（無法刪除已使用科目）']);
                return redirect()->route('account::main');
            }
        } else {
            Session::flash('toast_message', ['type' => 'warning', 'content' => '刪除會計科目「' . $deleteAccountName . '」失敗（無法刪除父科目）']);
            return redirect()->route('account::main');
        }
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

            $result = DB::select('select max(id) + 1 as max_id from account where cast(parent_id  as UNSIGNED) = ?', [$request->get('parent_id')]);
            
            if ($result[0]->max_id === null) {
                return response()->json(['type' => 'Success', 'content' => 1]);
            } else {
                $check = True;
                $count = 1;
                $useableId = null;
                while ($check && $count <= $result[0]->max_id) {
                    $number = DB::select('select id from account where cast(parent_id as UNSIGNED) = :parent_id and cast(id as UNSIGNED) = :id', ['parent_id' => $request->get('parent_id'), 'id' => $count]);
                    if ($number == null) {
                        $useableId = $count;
                        $check = False;
                    } elseif ($count === $result[0]->max_id) {
                        $useableId = $result[0]->max_id;
                        $check = False;
                    } else {
                        $count = $count + 1;
                    }
                }
                return response()->json(['type' => 'Success', 'content' => $useableId]);
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
            $result = DB::select('select concat(parent_id,id) as id from full_id where full_id >= cast(:head as UNSIGNED) and full_id < cast(:tail as UNSIGNED)', ['head' => $startId, 'tail' => $endId]);

            return response()->json(['type' => 'Success', 'content' => $result]);
        }
    }
}