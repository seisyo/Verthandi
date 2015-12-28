<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use Session;
use Validator;

class EventController extends Controller
{
    public function showEventMain($id)
    {
        return view('event.main')->with(['eventList' => Event::all(), 'eventInfo' => Event::find($id)]);
    }

    public function showEventDiary($id)
    {
        return view('event.diary')->with(['eventList' => Event::all(), 'eventInfo' => Event::find($id)]);
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
}