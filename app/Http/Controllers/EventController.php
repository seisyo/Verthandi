<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Event;
use App\Trade;
use App\Diary;
use App\Account;

use Session;
use Validator;
use DB;

class EventController extends Controller
{
    public function showEventMain($id)
    {
        return view('event.main')->with(['eventList' => Event::all(), 'eventInfo' => Event::find($id)]);
    }

    public function showEventDiary($id)
    {
        $parentIdList = Account::select('parent_id')->distinct()->get();
        $parentIdArray =[];
        
        foreach ($parentIdList as $parentId) {
            array_push($parentIdArray, $parentId['parent_id']);
        }

        return view('event.diary')->with(['eventList' => Event::all(), 'eventInfo' => Event::find($id), 'tradeList' => Trade::where('event_id', '=', $id)->get(), 'accountList' => Account::all(), 'parentList' => $parentIdArray]);
    }

    public function showEventLedger($id)
    {
        return view('event.ledger')->with(['eventList' => Event::all(), 'eventInfo' => Event::find($id)]);
    }

    public function showEventManage()
    {
        return view('event.manage')->with(['eventList' => Event::all()]);
    }

    public function addEvent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:45',
            'event_at' => 'required|date'
        ]);
        
        Event::create([
            'name' => $request->get('name'),
            'event_at' => date("Y-m-d", strtotime($request->get('event_at')))
        ]);

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增活動「' . $request->get('name') . '」']);
        
        return redirect()->route('event::manage');
    }

    public function editEvent(Request $request)
    {
        $validator = Validator::make(
        [
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'event_at' => $request->get('event_at')
        ],
        [
            'id' => 'required|exists:event,id',
            'name' => 'required|max:45',
            'event_at' => 'required|date'
        ]);

        if ($validator->fails()) {

            $errorname = 'errors' . $request->get('id');
            
            return redirect()->route('event::manage')->with($errorname, $validator->messages());

        } else {

            Event::find($request->get('id'))->update([
                'name' => $request->get('name'),
                'event_at' => date("Y-m-d", strtotime($request->get('event_at')))
            ]);

            Session::flash('toast_message', ['type' => 'success', 'content' => '成功更新活動「' . Event::find($request->get('id'))->name . '」']);
            
            return redirect()->route('event::manage');

        }
    }

    public function deleteEvent(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:event,id'
        ]);

        $deleteEvent = Event::find($request->get('id'))->name;
        Event::find($request->get('id'))->delete();

        Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除活動「' . $deleteEvent . '」']);
        return redirect()->route('event::manage');
    }

    public function searchAllEvent()
    {
        return response()->json(Event::all());
    }

    public function searchByIdEvent(Request $request)
    {
        $validator = Validator::make(
        [
            'id' => $request->get('id')
        ],
        [
            'id' => 'required|exists:event,id'
        ]);

        if ($validator->fails()) {

            $result = ['message' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);

        } else {

            $gets = Event::find($request->get('id'));
            return response()->json(['message' => 'Success', 'content' => $gets]);
        }
    }

    public function addEventDiary(Request $request, $id)
    {
        //!!!start validate!!!

        //first validate
        $validator1 = Validator::make(
        [  
            'event_id' => $id,
            'trade_at' => $request->get('trade_at'),
            'name' => $request->get('name'),
            'handler' => $request->get('handler'),
            'comment' => $request->get('comment'),
            'debit_array' => $request->get('debit_array'),
            'credit_array' => $request->get('credit_array')
        ],
        [
            'event_id' => 'required|exists:event,id',
            'trade_at' => 'required|date',
            'name' => 'required|max:95',
            'handler' => 'required|max:15',
            'comment' => 'string',
            'debit_array' => 'required|json',
            'credit_array' => 'required|json'
        ]);

        //decode string to json
        $debitDictionary = json_decode($request->get('debit_array'));
        $creditDictionary = json_decode($request->get('credit_array'));
        
        //to check the balance
        $debitTotal = 0;
        $creditTotal = 0;
        
        //validate debit account
        foreach ($debitDictionary as $debit) {
            $validator2 =  Validator::make(
            [
                'account' => $debit->account,
                'amount' => $debit->amount
            ],
            [
                'account' => 'required|exists:account,id',
                'amount' => 'required|numeric|min:0'
            ]);
            $debitTotal = $debitTotal + $debit->amount; 
        }

        //validate credit account
        foreach ($creditDictionary as $credit) {
            $validator3 =  Validator::make(
            [
                'account' => $credit->account,
                'amount' => $credit->amount
            ],
            [
                'account' => 'required|exists:account,id',
                'amount' => 'required|numeric|min:0'
            ]);
            $creditTotal = $creditTotal + $credit->amount;
        }
        
        //!!!end validate!!!

        if ($validator1->fails() || $validator2->fails() || $validator3->fails()) {
            
            return redirect()->route('event::diary', ['id' => $id])->with('errors', $validator1->messages()->merge($validator2->messages())->merge($validator3->messages()));

        } else {

            if ($debitTotal !== $creditTotal) {

                return redirect()->route('event::diary', ['id' => $id])->with('errors', new MessageBag(['It is not balanced']));

            } else {

                DB::transaction(function() use ($request, $id, $debitDictionary, $creditDictionary){

                    //create the trade
                    $trade = Trade::create([
                        'name' => $request->get('name'),
                        'handler' => $request->get('handler'),
                        'comment' => $request->get('comment'),
                        'event_id' => $id,
                        'trade_at' => date("Y-m-d", strtotime($request->get('trade_at'))),
                        'user_id' => Session::get('user')->id
                    ]);

                    foreach ($debitDictionary as $debit) {
                        
                        Diary::create([
                            'direction' => 1,
                            'amount' => $debit->amount,
                            'trade_id' => $trade->id,
                            'account_id' => $debit->account,
                        ]);

                    }

                    foreach ($creditDictionary as $credit) {
                        
                        Diary::create([
                            'direction' => 0,
                            'amount' => $credit->amount,
                            'trade_id' => $trade->id,
                            'account_id' => $credit->account,
                        ]);

                    }
                });
            }
        }
        
        Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增交易「' . $request->get('name') . '」']);
        return redirect()->route('event::diary', ['id' => $id]);
    }

    public function editEventDiary(Request $request, $id)
    {
        //!!!start validate!!!

        //first validate
        $validator1 = Validator::make(
        [  
            'event_id' => $id,
            'trade_id' => $request->get('trade_id'),
            'trade_at' => $request->get('trade_at'),
            'name' => $request->get('name'),
            'handler' => $request->get('handler'),
            'comment' => $request->get('comment'),
            'debit_array' => $request->get('debit_array'),
            'credit_array' => $request->get('credit_array')
        ],
        [
            'event_id' => 'required|exists:event,id',
            'trade_id' => 'required|exists:trade,id',
            'trade_at' => 'required|date',
            'name' => 'required|max:95',
            'handler' => 'required|max:15',
            'comment' => 'string',
            'debit_array' => 'required|json',
            'credit_array' => 'required|json'
        ]);

        //decode string to json
        $debitDictionary = json_decode($request->get('debit_array'));
        $creditDictionary = json_decode($request->get('credit_array'));
        
        //to check the balance
        $debitTotal = 0;
        $creditTotal = 0;
        
        //validate debit account
        foreach ($debitDictionary as $debit) {
            $validator2 =  Validator::make(
            [
                'account' => $debit->account,
                'amount' => $debit->amount
            ],
            [
                'account' => 'required|exists:account,id',
                'amount' => 'required|numeric|min:0'
            ]);
            $debitTotal = $debitTotal + $debit->amount; 
        }

        //validate credit account
        foreach ($creditDictionary as $credit) {
            $validator3 =  Validator::make(
            [
                'account' => $credit->account,
                'amount' => $credit->amount
            ],
            [
                'account' => 'required|exists:account,id',
                'amount' => 'required|numeric|min:0'
            ]);
            $creditTotal = $creditTotal + $credit->amount;
        }
        
        //!!!end validate!!!

        if ($validator1->fails() || $validator2->fails() || $validator3->fails()) {
            
            return redirect()->route('event::diary', ['id' => $id])->with('errors' . $request->get('trade_id'), $validator1->messages()->merge($validator2->messages())->merge($validator3->messages()));

        } else {
            
            if ($debitTotal !== $creditTotal) {
                
                return redirect()->route('event::diary', ['id' => $id])->with('errors' . $request->get('trade_id'), new MessageBag(['It is not balanced']));

            } else {

                DB::transaction(function() use ($request, $id, $debitDictionary, $creditDictionary){

                    //create the trade
                    Trade::find($request->get('trade_id'))->update([
                        'name' => $request->get('name'),
                        'handler' => $request->get('handler'),
                        'comment' => $request->get('comment'),
                        'event_id' => $id,
                        'trade_at' => date("Y-m-d", strtotime($request->get('trade_at'))),
                        'user_id' => Session::get('user')->id
                    ]);

                    $diarys = Trade::find($request->get('trade_id'))->diary;

                    foreach ($diarys as $diary) {
                        $diary->delete();
                    }

                    foreach ($debitDictionary as $debit) {
                        
                        Diary::create([
                            'direction' => 1,
                            'amount' => $debit->amount,
                            'trade_id' => $request->get('trade_id'),
                            'account_id' => $debit->account,
                        ]);

                    }

                    foreach ($creditDictionary as $credit) {
                        
                        Diary::create([
                            'direction' => 0,
                            'amount' => $credit->amount,
                            'trade_id' => $request->get('trade_id'),
                            'account_id' => $credit->account,
                        ]);

                    }
                });
            }
        }
        
        Session::flash('toast_message', ['type' => 'success', 'content' => '成功編輯交易「' . $request->get('name') . '」']);
        return redirect()->route('event::diary', ['id' => $id]);
    }

    public function deleteEventDiary(Request $request, $id)
    {
        $validator = Validator::make(
        [
            'event_id' => $id,
            'trade_id' => $request->get('trade_id')
        ],
        [
            'event_id' => 'required|exists:event,id',
            'trade_id' => 'required|exists:trade,id'
        ]);

        if ($validator->fails()) {
            
            return redirect()->route('event::diary', ['id' => $id])->with('errors' . $request->get('trade_id'), $validator->messages());
        
        } else {

            $diarys = Trade::find($request->get('trade_id'))->diary;

            foreach ($diarys as $diary) {
                $diary->delete();
            }

            $deleteTrade = Trade::find($request->get('trade_id'))->name;
            Trade::find($request->get('trade_id'))->delete();

            Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除交易「' . $deleteTrade . '」']);
            return redirect()->route('event::diary', ['id' => $id]);

        }
    }
}