<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TrashedNoteController extends Controller
{
    public function index(){
        $notes = Auth::user()->notes()->onlyTrashed()->latest('updated_at')->paginate(10);
        return view('notes.index')->with('notes',$notes);
    }
    public function show($uuid){

        $note = Note::where('uuid',$uuid)->where('user_id',Auth::id())->onlyTrashed()->firstOrFail();
        if(!$note->user->is(Auth::user())){
            return abort(403);
        }
        return view('notes.show')->with('note',$note);
    }
    public function update($uuid){
        //dd('sd');
        if(!Auth::user()->is(Auth::user())){
            return abort(403);
        }
        $note = Note::where('uuid',$uuid);
        $note->restore();
        //return back();
        $notes = Auth::user()->notes()->onlyTrashed()->latest('updated_at')->paginate(10);
        return redirect('notes')->with('success','Note Restore Successfully');
        //return redirect('notes.show',$note)->with('success','Note Restored Successfully');
    }
    public function destroy($uuid){

        $note = Note::where('uuid',$uuid);
        $note->forceDelete();
        //$note = Note::where('uuid',$uuid)->onlyTrashed()->firstOrFail();
        return redirect('trashed')->with('success','Note Deleted Forever Successfully');

    }
}
