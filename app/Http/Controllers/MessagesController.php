<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Redirect;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $hiddenAjaxUrl = '/admin/messages';

        if($filter){
            if($filter === 'read') {
                $hiddenAjaxUrl = '/admin/messages?filter=read';
            }
            if($filter === 'unread') {
                $hiddenAjaxUrl = '/admin/messages?filter=unread';
            }
        }

        if ($request->ajax()) {

            $sqlFilter = ['archive' => 0];

            if($filter){
                if($filter === 'read') {
                    $sqlFilter = ['archive' => 0, 'unread' => 0];
                }
                if($filter === 'unread') {
                    $sqlFilter = ['archive' => 0, 'unread' => 1];
                }
            }

            $data = Messages::latest()->where($sqlFilter)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/admin/messages/' . $row->id . '" class="edit btn btn-sm btn-primary">Részletek</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.messages.messages')
                    ->with('hiddenAjaxUrl', $hiddenAjaxUrl);
    }

    public function show(Request $request, $id)
    {
        $message = Messages::find($id);
        
        return view('admin.messages.unread')
                    ->with('id', $id)
                    ->with('message', $message);

    }

    public function setTotRead(Request $request, $id)
    {
        $message = Messages::find($id);

        $message->unread = true;

        $message->save();

        return redirect()->route('messages');
    }

    public function archiveMessage(Request $request, $id)
    {
        $message = Messages::find($id);

        $message->archive = true;

        $message->save();

        return redirect()->route('messages');
    }

    public function message()
    {
        return view('messages.message');
    }

    public function store(Request $request)
    {
        try {

            $email = $request->input('email');
            $message = $request->input('message');
            $firmName = $request->input('firm_name');
            $fullName = $request->input('full_name');
            $phoneNumber = $request->input('phone_number');
            
            $newMessage = new Messages();
            
            $newMessage->email = $email;
            $newMessage->message = $message;
            $newMessage->firm_name = $firmName;
            $newMessage->full_name = $fullName;
            $newMessage->phone_number = $phoneNumber;
            
            $newMessage->save();

            return back()->with('success', 'Az üzenet sikeresen elküldve!');
            
        } catch(Exception $e) {
            return back()->with('error', 'Hiba az üzenet elküldése során!');
        }
        
    }
}
