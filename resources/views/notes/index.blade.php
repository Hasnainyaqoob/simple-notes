@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ request()->routeIs('notes.index') ? __('All Notes') : __('Trashed Notes') }}</div>

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
                    {{--{{ __('Simple Notes Taking App') }}--}}
                </div>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                @if(request()->routeIs('notes.index'))
                    <a class="btn btn-outline-primary" href="{{route('notes.create')}}">+ New Note </a>
                @endif
            </div>
            <div class="col-md-12 mt-3">
                @forelse($notes as $note)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h2 class="mt-2 mb-3">
                                <a
                                    @if(request()->routeIs('notes.index'))
                                    href="{{route('notes.show',$note)}}">
                                    @else
                                        href="{{route('trashed.show',$note)}}">
                                    @endif
                                    {{$note->title}}</a>
                            </h2>
                            <p>{!!Str::limit($note->text,200)!!}</p>
                            <span class="text-sm-left text-black-50">{{$note->updated_at->diffForHumans()}}</span>
                        </div>
                    </div>
                @empty
                    @if(request()->routeIs('notes.index'))
                        <h2>Lets Make your first note!</h2>
                    @else
                        <h2>Wow! your trash is empty.</h2>
                    @endif
                @endforelse
                {{$notes->links()}}
            </div>
        </div>

@endsection


