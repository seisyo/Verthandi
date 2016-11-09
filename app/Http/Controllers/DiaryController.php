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
use Response;

class DiaryController extends Controller
{
    public function showEventDiary($eventId, $page=1)
    {
        $pageSize = 10;
        $accountArray = DB::select('select full_id, name from full_id where cast(concat(parent_id,id) as UNSIGNED) not in (select parent_id from account)');
        return view('event.diary')->with(['eventList' => Event::all(), 
                                          'eventInfo' => Event::find($eventId), 
                                          'tradeList' => Trade::where('event_id', '=', $eventId)->orderBy('trade_at', 'asc')->skip(($page-1)*$pageSize)->take($pageSize)->get(), 
                                          'accountList' => json_encode($accountArray),
                                          'fileLinkList' => DiaryAttachedFiles::where('event_id', '=', $eventId)->get(),
                                          'totalPageNumber' => ceil(Trade::where('event_id', '=', $eventId)->count() / $pageSize),
                                          'currentPageNumber' => $page
                                        ]);
    }

    public function addEventDiary(Request $request, $eventId)
    {
        // first validate
        $validatorTotal = Validator::make(
        [  
            'event_id' => $eventId,
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
            'handler' => 'max:15',
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
                'amount' => 'required|numeric|integer|min:1'
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
                'amount' => 'required|numeric|integer|min:1'
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
                    if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'pdf'])) {
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
            return redirect()->route('event::diary', ['eventId' => $eventId])->with('errors', $validatorTotal->messages());

        } else {

            $transaction = DB::transaction(function() use ($request, $eventId, $debitDictionary, $creditDictionary, $files){

                //create the trade
                $trade = Trade::create([
                    'name' => $request->get('name'),
                    'handler' => $request->get('handler'),
                    'comment' => $request->get('comment'),
                    'event_id' => $eventId,
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
                        $filePath = join(DIRECTORY_SEPARATOR, ['app', 'diary', $eventId, $trade->id]);
                        $fileName = join('-', [$eventId, $trade->id, $key + 1, '.' . $file->getClientOriginalExtension()]);
                        
                        // move the file
                        $file->move(storage_path($filePath), $fileName);

                        DiaryAttachedFiles::create([
                            'event_id' => $eventId,
                            'trade_id' => $trade->id,
                            'file_number' => $key + 1,
                            'file_name' => $fileName,
                            'uploader' => Session::get('user')->id
                        ]);
                    }
                }
            });
            
        }
        
        if (is_null($transaction)) {
            Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增交易「' . $request->get('name') . '」']);
            return redirect()->route('event::diary', ['eventId' => $eventId]);
        } else {
            Session::flash('toast_message', ['type' => 'error', 'content' => '新增交易「' . $request->get('name') . '」失敗']);
            return redirect()->route('event::diary', ['eventId' => $eventId]);
        }
    }

    public function editEventDiary(Request $request, $eventId)
    {
        //first validate
        $validatorTotal = Validator::make(
        [  
            'event_id' => $eventId,
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
            'handler' => 'max:15',
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
                'amount' => 'required|numeric|integer|min:1'
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
                'amount' => 'required|numeric|integer|min:1'
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
                    $validatorTotal->messages()->merge(new MessageBag(['上傳收據檔案失敗']));
                } else {
                    // check the file name
                    if (!in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'pdf'])) {
                        $validatorTotal->messages()->merge(new MessageBag(['上傳收據檔案檔名不符']));
                    }
                    // check the file size
                    if ($file->getMaxFilesize() < $file->getClientSize()) {
                        $validatorTotal->messages()->merge(new MessageBag(['上傳收據檔案過大']));
                    }
                }
            }
            
        }
        //!!!end validate!!!

        if (!$validatorTotal->messages()->isEmpty()) {

            return redirect()->route('event::diary', ['eventId' => $eventId])->with('errors' . $request->get('trade_id'), $validatorTotal->messages());

        } else {

            $transaction = DB::transaction(function() use ($request, $eventId, $debitDictionary, $creditDictionary, $files){

                //edit the trade
                Trade::find($request->get('trade_id'))->update([
                    'name' => $request->get('name'),
                    'handler' => $request->get('handler'),
                    'comment' => $request->get('comment'),
                    'event_id' => $eventId,
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

                // move the file to the storage/app/user-upload
                if ($request->hasFile('diary_attached_files')) {

                    foreach ($files as $key => $file) {
                        // create the file's storage path & name
                        $filePath = join(DIRECTORY_SEPARATOR, ['app', 'diary', $eventId, $request->get('trade_id')]);
                        $useableId = DB::select('select max(file_number) + 1 as useable_id from diary_attached_files where event_id = :eid and trade_id = :tid', ['eid' => $eventId, 'tid' => $request->get('trade_id')])[0]->useable_id;
                        if ($useableId === null) {
                            $useableId = 1;
                        }
                        $fileName = join('-', [$eventId, $request->get('trade_id'), $useableId, '.' . $file->getClientOriginalExtension()]);
                        // move the file
                        $file->move(storage_path($filePath), $fileName);

                        DiaryAttachedFiles::create([
                            'event_id' => $eventId,
                            'trade_id' => $request->get('trade_id'),
                            'file_number' => $useableId,
                            'file_name' => $fileName,
                            'uploader' => Session::get('user')->id
                        ]);
                    }
                }
            });
        }
        
        if (is_null($transaction)) {
            Session::flash('toast_message', ['type' => 'success', 'content' => '成功編輯交易「' . $request->get('name') . '」']);
            return redirect()->route('event::diary', ['eventId' => $eventId]);
        } else {
            Session::flash('toast_message', ['type' => 'error', 'content' => '編輯交易「' . $request->get('name') . '」失敗']);
            return redirect()->route('event::diary', ['eventId' => $eventId]);
        }    
    }

    public function deleteEventDiary(Request $request, $eventId)
    {
        $validator = Validator::make(
        [
            'event_id' => $eventId,
            'trade_id' => $request->get('trade_id')
        ],
        [
            'event_id' => 'required|exists:event,id',
            'trade_id' => 'required|exists:trade,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('event::diary', ['eventId' => $eventId])->with('errors' . $request->get('trade_id'), $validator->messages());
        } else {

            // save the trade name
            $deleteTrade = Trade::find($request->get('trade_id'))->name;

            $transaction = DB::transaction(function() use ($request, $eventId){
                // delete the relate file's
                $files = DiaryAttachedFiles::where('event_id', '=', $eventId)->where('trade_id', '=', $request->get('trade_id'))->get();
                foreach ($files as $file) {
                    // Storage::delete(join(DIRECTORY_SEPARATOR, ['diary', $file->event_id, $file->trade_id, $file->file_name]));
                    $file->delete();
                }
                // delete the relate diarys
                $diarys = Trade::find($request->get('trade_id'))->diary;
                foreach ($diarys as $diary) {
                    $diary->delete();
                }
                // delete the trade 
                Trade::find($request->get('trade_id'))->delete();
            });

            if (is_null($transaction)) {
                Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除交易「' . $deleteTrade . '」']);
                return redirect()->route('event::diary', ['eventId' => $eventId]);
            } else {
                Session::flash('toast_message', ['type' => 'error', 'content' => '刪除交易「' . $deleteTrade . '」失敗']);
                return redirect()->route('event::diary', ['eventId' => $eventId]);
            } 
        }
    }

    public function downloadAttachedFile($fileName)
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
            
            $file = DiaryAttachedFiles::where('file_name', '=', $fileName)->first();
            $filePath = join(DIRECTORY_SEPARATOR, ['app', 'diary', $file->event_id, $file->trade_id]);
            $pathToFile = storage_path($filePath . DIRECTORY_SEPARATOR . $fileName);
            $fileType = File::type($pathToFile);

            $response = Response::make( File::get($pathToFile), 200);
            $response->header("Content-Type", $fileType);

            return $response;
        }
    }

    // API
    public function deleteAttachedFile(Request $request)
    {
        $validator = Validator::make(
        [
            'file_name' => $request->get('file_name')
        ],
        [
            'file_name' => 'required|exists:diary_attached_files,file_name'
        ]);

        if ($validator->fails()) {
            $result = ['type' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);
        } else {
            $file = DiaryAttachedFiles::where('file_name', '=', $request->get('file_name'))->first();      
            
            // Storage::delete(join(DIRECTORY_SEPARATOR, ['diary', $file->event_id, $file->trade_id, $file->file_name]));
            $file->delete();
            
            return response()->json(['type' => 'Success', 'content' => '已刪除']);
        }
    }
}