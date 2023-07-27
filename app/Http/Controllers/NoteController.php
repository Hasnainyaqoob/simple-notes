<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$userId = Auth::id();
        //$notes = Note::where('user_id',Auth::id())->latest('updated_at')->paginate(10);
        $notes = Auth::user()->notes()->latest('updated_at')->paginate(10);
        return view('notes.index')->with('notes',$notes);

        /*$notes->each(function ($notes){
            dump($notes->title);
        });*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:200',
            'text'=>'required'
        ]);

        //$note = new Note([
        //Note::create([
        Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            //'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text,
        ]);
        //$note->save();

        return redirect('notes')->with('success','Note Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //Applied Route Model Binding---- This RMB works same as code line below

        //$note = Note::where('uuid',$uuid)->where('user_id',Auth::id())->firstOrFail();
        //if($note->user_id != Auth::id()){
        if(!$note->user->is(Auth::user())){
            return abort(403);
        }

        //dd($note);
        return view('notes.show')->with('note',$note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        if(!$note->user->is(Auth::user())){
            return abort(403);
        }

        //dd($note);
        return view('notes.edit')->with('note',$note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        if(!$note->user->is(Auth::user())){
            return abort(403);
        }
        $request->validate([
            'title'=>'required|max:200',
            'text'=>'required'
        ]);
        $note->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);
        return view('notes.show',['note'=>$note])->with('success','Note Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if(!$note->user->is(Auth::user())){
            return abort(403);
        }
        $note->delete();

        return redirect('notes')->with('success','Note Moved to Trash Successfully');

    }
}
