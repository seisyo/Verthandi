<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

use DB;

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
        //dd($eventId);
        return response()->json(['type' => 'Success', 'content' => $eventId]);
    }
}