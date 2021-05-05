<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use DataTables;
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
                    $btn = '<a href="/admin/messages/' . $row->id . '" class="edit btn btn-primary">Részletek</a>';
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
}