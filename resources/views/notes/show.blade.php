@extends('layouts.app')

@section('content')
    <style>
        p {
            white-space: pre-wrap;
        }
    </style>
    <div class="container">


        <div class="col-md-12 row">
            @if(!$note->trashed())
            <div class="col-md-6">
                <span class="mr-3"><strong>Created: </strong>{{$note->created_at->diffForHumans()}}</span>
                <span><strong>Updated: </strong>{{$note->updated_at->diffForHumans()}}</span>
            </div>
                <div class="col-md-6 d-flex ml-auto">
                    <a class="btn btn-outline-success mr-3 ml-auto" href="{{route('notes.edit',$note)}}">Edit Note</a>
                    <form action="{{route('notes.destroy',$note)}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this note?')">Move to Trash</button>
                    </form>
                </div>
            @else
                <div class="col-md-6 d-flex ml-auto">
                    <span class="mr-3"><strong>Deleted: </strong>{{$note->deleted_at->diffForHumans()}}</span>
                </div>
                    <div class="col-md-6 d-flex ml-auto">
                    <form class="ml-auto" action="{{route('trashed.update',$note)}}" method="post">
                        @method('put')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Restore Note</button>
                    </form>
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you wish to delete this note forever? This action cannot be undone')">Delete Forever</button>
                    </form>
                </div>



            @endif
        </div>
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="col-md-12  mt-3">
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h2 class="mb-3">{{$note->title}}</h2>
                    <p class="mt-2">{!!$note->text!!}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
