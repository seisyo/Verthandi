<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use App\Event;
use App\Trade;
use App\Diary;
use App\Account;
use App\DiaryAttachedFiles;

use Session;
use Validator;
use DB;
use Storage;
use File;

class DiaryController extends Controller
{
    public function showEventDiary($id)
    {
        $accountArray = DB::select('select full_id, name from full_id where cast(concat(parent_id,id) as INTEGER) not in (select parent_id from account)');
        return view('event.diary')->with(['eventList' => Event::all(), 
                                          'eventInfo' => Event::find($id), 
                                          'tradeList' => Trade::where('event_id', '=', $id)->get(), 
                                          'accountList' => json_encode($accountArray),
                                          'fileLinkList' => DiaryAttachedFiles::where('event_id', '=', $id)->get()
                                        ]);
    }

    public function addEventDiary(Request $request, $id)
    {
        // first validate
        $validatorTotal = Validator::make(
        [  
            'event_id' => $id,
            'trade_at' => $request->get('trade_at'),
            'name' => $request->get('name'),
            'handler' => $request->get('handler'),
            'comment' => $request->get('comment'),
            'debit_array' => $request->get('debit_array'),
            'credit_array' => $request->get('credit_array'),
        ],
        [
            'event_id' => 'required|exists:event,id',
            'trade_at' => 'required|date',
            'name' => 'required|max:95',
            'handler' => 'required|max:15',
            'comment' => 'string',
            'debit_array' => 'required|json',
            'credit_array' => 'required|json',
        ]);

        //decode string to json
        $debitDictionary = json_decode($request->get('debit_array'));
        $creditDictionary = json_decode($request->get('credit_array'));
        
        //to check the balance
        $debitTotal = 0;
        $creditTotal = 0;

        //validate debit account
        foreach ($debitDictionary as $debit) {

            $debitConcatId = trim($debit->account, "0");
            
            $debitAccountId = substr($debitConcatId, strlen($debitConcatId) - 1);
            $debitAccountParentId = substr($debitConcatId, 0, strlen($debitConcatId) - 1);

            $validator =  Validator::make(
            [
                'account_id' => $debitAccountId,
                'account_parent_id' => $debitAccountParentId,
                'amount' => $debit->amount
            ],
            [
                'account_id' => 'required|exists:account,id',
                'account_parent_id' => 'required|exists:account,parent_id',
                'amount' => 'required|numeric|min:1'
            ]);
            
            //merge the error message
            if ($validator->fails()) {
                $validatorTotal->messages()->merge($validator->messages());
            }

            $debitTotal = $debitTotal + $debit->amount; 
        }

        //validate credit account
        foreach ($creditDictionary as $credit) {
            
            $creditConcatId = trim($credit->account, "0");
            
            $creditAccountId = substr($creditConcatId, strlen($creditConcatId) - 1);
            $creditaAccountParentId = substr($creditConcatId, 0, strlen($creditConcatId) - 1);

            $validator =  Validator::make(
            [
                'account_id' => $creditAccountId,
                'account_parent_id' => $creditaAccountParentId,
                'amount' => $credit->amount
            ],
            [
                'account_id' => 'required|exists:account,id',
                'account_parent_id' => 'required|exists:account,parent_id',
                'amount' => 'required|numeric|min:1'
            ]);

            //merge the error message
            if ($validator->fails()) {
                $validatorTotal->messages()->merge($validator->messages());
            }

            $creditTotal = $creditTotal + $credit->amount;
        }
        // check balace
        if ($debitTotal !== $creditTotal) {
            $validatorTotal->messages()->merge(new MessageBag(['借貸不平衡']));
        }

        // check date
        if (date("Y-m-d", strtotime($request->get('trade_at'))) > date("Y-m-d")) {
            $validatorTotal->messages()->merge(new MessageBag(['交易尚未發生']));
        }

        // check the upload file
        $files = $request->file('diary_attached_files');
            
        if ($request->hasFile('diary_attached_files')) {
            
            foreach ($files as $file) {
                
                if (!$file->isValid()) {
                    $validatorTotal->messages()->merge(new MessageBag(['上傳收據相片失敗']));
                } else {
                    // check the file name
                    if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png'])) {
                        $validatorTotal->messages()->merge(new MessageBag(['上傳收據相片檔名不符']));
                    }
                    // check the file size
                    if ($file->getMaxFilesize() < $file->getClientSize()) {
                        $validatorTotal->messages()->merge(new MessageBag(['上傳收據相片檔名過大']));
                    }
                }
            }
            
        }
        //end validate
        if (!$validatorTotal->messages()->isEmpty()) {
            
            $request->flash();
            return redirect()->route('event::diary', ['id' => $id])->with('errors', $validatorTotal->messages());

        } else {

            DB::transaction(function() use ($request, $id, $debitDictionary, $creditDictionary, $files){

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
                    
                    $debitConcatId = trim($debit->account, "0");
        
                    $debitAccountId = substr($debitConcatId, strlen($debitConcatId) - 1);
                    $debitAccountParentId = substr($debitConcatId, 0, strlen($debitConcatId) - 1);

                    //dd($debitAccountParentId);
                    Diary::create([
                        'direction' => 1,
                        'amount' => $debit->amount,
                        'trade_id' => $trade->id,
                        'account_id' => $debitAccountId,
                        'account_parent_id' => $debitAccountParentId
                    ]);

                }

                foreach ($creditDictionary as $credit) {
                    
                    $creditConcatId = trim($credit->account, "0");
        
                    $creditAccountId = substr($creditConcatId, strlen($creditConcatId) - 1);
                    $creditaAccountParentId = substr($creditConcatId, 0, strlen($creditConcatId) - 1);

                    Diary::create([
                        'direction' => 0,
                        'amount' => $credit->amount,
                        'trade_id' => $trade->id,
                        'account_id' => $creditAccountId,
                        'account_parent_id' => $creditaAccountParentId
                    ]);

                }
                // move the file to the storage/app/user-upload
                if ($request->hasFile('diary_attached_files')) {

                    foreach ($files as $key => $file) {
                        // create the file's storage path & name
                        $filePath = join(DIRECTORY_SEPARATOR, ['app', 'diary', $id, $trade->id]);
                        $fileName = join('_', [$id, $trade->id, $key + 1, '.' . $file->getClientOriginalExtension()]);
                        
                        // move the file
                        $file->move(storage_path($filePath), $fileName);

                        DiaryAttachedFiles::create([
                            'event_id' => $id,
                            'trade_id' => $trade->id,
                            'file_path' => $filePath,
                            'file_name' => $fileName,
                            'uploader' => Session::get('user')->id
                        ]);
                    }
                }
            });
            
        }
        
        Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增交易「' . $request->get('name') . '」']);
        return redirect()->route('event::diary', ['id' => $id]);
    }

    public function editEventDiary(Request $request, $id)
    {
        //!!!start validate!!!

        //first validate
        $validatorTotal = Validator::make(
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
            
            $debitConcatId = trim($debit->account, "0");
            
            $debitAccountId = substr($debitConcatId, strlen($debitConcatId) - 1);
            $debitAccountParentId = substr($debitConcatId, 0, strlen($debitConcatId) - 1);

            $validator =  Validator::make(
            [
                'account_id' => $debitAccountId,
                'account_parent_id' => $debitAccountParentId,
                'amount' => $debit->amount
            ],
            [
                'account_id' => 'required|exists:account,id',
                'account_parent_id' => 'required|exists:account,parent_id',
                'amount' => 'required|numeric|min:1'
            ]);
            //merge the error message
            if ($validator->fails()) {
                $validatorTotal->messages()->merge($validator->messages());
            }

            $debitTotal = $debitTotal + $debit->amount; 
        }

        //validate credit account
        foreach ($creditDictionary as $credit) {
            
            $creditConcatId = trim($credit->account, "0");
            
            $creditAccountId = substr($creditConcatId, strlen($creditConcatId) - 1);
            $creditaAccountParentId = substr($creditConcatId, 0, strlen($creditConcatId) - 1);

            $validator =  Validator::make(
            [
                'account_id' => $creditAccountId,
                'account_parent_id' => $creditaAccountParentId,
                'amount' => $credit->amount
            ],
            [
                'account_id' => 'required|exists:account,id',
                'account_parent_id' => 'required|exists:account,parent_id',
                'amount' => 'required|numeric|min:1'
            ]);
            //merge the error message
            if ($validator->fails()) {
                $validatorTotal->messages()->merge($validator->messages());
            }

            $creditTotal = $creditTotal + $credit->amount;
        }
        // check balace
        if ($debitTotal !== $creditTotal) {
            $validatorTotal->messages()->merge(new MessageBag(['借貸不平衡']));
        }

        // check date
        if (date("Y-m-d", strtotime($request->get('trade_at'))) > date("Y-m-d")) {
            $validatorTotal->messages()->merge(new MessageBag(['交易尚未發生']));
        }

        //!!!end validate!!!

        if (!$validatorTotal->messages()->isEmpty()) {

            return redirect()->route('event::diary', ['id' => $id])->with('errors' . $request->get('trade_id'), $validatorTotal->messages());

        } else {

            DB::transaction(function() use ($request, $id, $debitDictionary, $creditDictionary){

                //edit the trade
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
                    
                    $debitConcatId = trim($debit->account, "0");
        
                    $debitAccountId = substr($debitConcatId, strlen($debitConcatId) - 1);
                    $debitAccountParentId = substr($debitConcatId, 0, strlen($debitConcatId) - 1);

                    Diary::create([
                        'direction' => 1,
                        'amount' => $debit->amount,
                        'trade_id' => $request->get('trade_id'),
                        'account_id' => $debitAccountId,
                        'account_parent_id' => $debitAccountParentId
                    ]);

                }

                foreach ($creditDictionary as $credit) {
                    
                    $creditConcatId = trim($credit->account, "0");
        
                    $creditAccountId = substr($creditConcatId, strlen($creditConcatId) - 1);
                    $creditaAccountParentId = substr($creditConcatId, 0, strlen($creditConcatId) - 1);

                    Diary::create([
                        'direction' => 0,
                        'amount' => $credit->amount,
                        'trade_id' => $request->get('trade_id'),
                        'account_id' => $creditAccountId,
                        'account_parent_id' => $creditaAccountParentId
                    ]);

                }
            });
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

    public function displayAttachedFile($fileName)
    {
        $validator = Validator::make(
        [
            'file_name' => $fileName
        ],
        [
            'file_name' => 'required|exists:diary_attached_files,file_name'
        ]);

        if ($validator->fails()) {
            return response($validator->messages());
        } else {
            $filePath = DiaryAttachedFiles::where('file_name', '=', $fileName)->first()->file_path;
            return response()->download(storage_path($filePath . DIRECTORY_SEPARATOR . $fileName));
        }
    }
}