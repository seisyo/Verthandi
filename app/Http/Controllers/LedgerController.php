<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Event;
use App\Diary;
use App\Trade;
use App\Account;

use DB;
use Validator;

class LedgerController extends Controller
{
    public function showEventLedger($eventId)
    {
        $accountArray = DB::select('select full_id, name from full_id where cast(concat(parent_id,id) as INTEGER) not in (select parent_id from account)');
        return view('event.ledger')->with(['eventList' => Event::all(),
                                           'eventInfo' => Event::find($eventId), 
                                           'accountList' => json_encode($accountArray)
                                        ]);
    }

    public function accountRecordSearch($eventId, Request $request)
    {
        $concatId = trim($request->get('account_id'), '0');
            
        $accountId = substr($concatId, strlen($concatId) - 1);
        $accountParentId = substr($concatId, 0, strlen($concatId) - 1);

        $validator = Validator::make(
        [
            'event_id' => $eventId,
            'account_id' => $accountId,
            'account_parent_id' => $accountParentId
        ],
        [
            'event_id' => 'required|exists:event,id',
            'account_id' => 'required|exists:account,id',
            'account_parent_id' => 'required|exists:account,parent_id'
        ]);
        // check the accountParentId + accountId exists in the account table
        $checkIdexist =  DB::select('select * from account where id = :account_id and parent_id = :account_parent_id', ['account_id' => $accountId, 'account_parent_id' => $accountParentId]);
        if (empty($checkIdexist)) {
            $validator->messages()->merge(new MessageBag(['科目不存在']));
        }
        // success or fail
        if (!$validator->messages()->isEmpty()) {
            $result = ['type' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);
        } else {
            return response()->json(['type' => 'Success', 'content' => $request->get('account_id')]);
        }        
        
    }
}