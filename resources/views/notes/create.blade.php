@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="col-md-12  mt-3">
                <div class="card col-md-8 offset-md-2 mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="mb-3">Create a new note</h3>
                        <form method="POST" action="{{ route('notes.store') }}">
                            @csrf

                            <input  id="title" type="text" placeholder="Note Title" class="form-control mb-3"  name="title" value="{{ old('title') }}" autofocus>
                            @error('title')
                            <span class="text-sm-left">{{$message}}</span>
                            @enderror
                            {{--<div id="toolbar-container"></div>
                            <div style="border: 1px solid lightgray" name="text" id="text">{{ old('notetext') }}</div>--}}
                            <textarea class="form-control" name="text" id="text" rows="10" placeholder="Start typing here..." value="{{ old('notetext') }}" ></textarea>
                            @error('text')
                            {{$message}}
                            @enderror
                            <div class="form-group mt-3 row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </div>


    <script>
        ClassicEditor
            .create( document.querySelector( '#text' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <style>
        .ck-editor__editable {
            height: 300px !important;
        }
    </style>
    {{--<script src="{{asset('ckeditor5/ckeditor.js')}}"></script>--}}
    {{--<script src="{{asset('ckfinder5/ckfinder.js')}}"></script>--}}
@endsection


