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

class EventController extends Controller
{
    public function showEventMain($id)
    {
        return view('event.main')->with(['eventList' => Event::all(), 'eventInfo' => Event::find($id)]);
    }

    public function showEventManage()
    {
        return view('event.manage')->with(['eventList' => Event::all()]);
    }

    public function addEvent(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:45',
            'event_at' => 'required|date',
            'principal' => 'required|max:15',
            'explanation' => 'string'
        ]);
        
        $result = Event::create([
            'name' => $request->get('name'),
            'event_at' => date("Y-m-d", strtotime($request->get('event_at'))),
            'principal' => $request->get('principal'),
            'explanation' => $request->get('explanation')
        ]);

        if ($result) {
            Session::flash('toast_message', ['type' => 'success', 'content' => '成功新增活動「' . $request->get('name') . '」']);
            return redirect()->route('event::manage');
        } else {
            Session::flash('toast_message', ['type' => 'error', 'content' => '新增活動「' . $request->get('name') . '」失敗']);
            return redirect()->route('event::manage');
        } 
    }

    public function editEvent(Request $request)
    {
        $validator = Validator::make(
        [
            'id' => $request->get('id'),
            'name' => $request->get('name'),
            'event_at' => $request->get('event_at'),
            'principal' => $request->get('principal'),
            'explanation' => $request->get('explanation')
        ],
        [
            'id' => 'required|exists:event,id',
            'name' => 'required|max:45',
            'event_at' => 'required|date',
            'principal' => 'required|max:15',
            'explanation' => 'string'
        ]);

        if ($validator->fails()) {

            $errorname = 'errors' . $request->get('id');
            return redirect()->route('event::manage')->with($errorname, $validator->messages());

        } else {

            $result = Event::find($request->get('id'))->update([
                'name' => $request->get('name'),
                'event_at' => date("Y-m-d", strtotime($request->get('event_at'))),
                'principal' => $request->get('principal'),
                'explanation' => $request->get('explanation')
            ]);

            if ($result) {
                Session::flash('toast_message', ['type' => 'success', 'content' => '成功更新活動「' . Event::find($request->get('id'))->name . '」']);
                return redirect()->route('event::manage');
            } else {
                Session::flash('toast_message', ['type' => 'error', 'content' => '更新活動「' . Event::find($request->get('id'))->name . '」失敗']);
                return redirect()->route('event::manage');
            }
        }
    }

    public function deleteEvent(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:event,id'
        ]);

        $deleteEventName = Event::find($request->get('id'))->name;
        $deleteEvent = Event::find($request->get('id'));

        $transaction = DB::transaction(function() use ($deleteEvent){
            foreach ($deleteEvent->trade as $trade) {
                foreach ($trade->diary as $diary) {
                    // echo($diary . '<tr>');
                    $diary->delete();
                }
                foreach ($trade->diaryAttachedFiles as $file) {
                    // echo($file . '<tr>');
                    Storage::delete(join(DIRECTORY_SEPARATOR, ['diary', $file->event_id, $file->trade_id, $file->file_name]));
                    $file->delete();
                }
                // echo($trade . '<tr>');
                $trade->delete();
            }
            $deleteEvent->delete();
        });

        if (is_null($transaction)) {
            Session::flash('toast_message', ['type' => 'success', 'content' => '成功刪除活動「' . $deleteEventName . '」']);
            return redirect()->route('event::manage');
        } else {
            Session::flash('toast_message', ['type' => 'error', 'content' => '刪除活動「' . $deleteEventName . '」失敗']);
            return redirect()->route('event::manage');
        }        
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
            $result = ['type' => 'Failed', 'content' => $validator->messages()];
            return response()->json($result);
        } else {
            $gets = Event::find($request->get('id'));
            return response()->json(['type' => 'Success', 'content' => $gets]);
        }
    }
}