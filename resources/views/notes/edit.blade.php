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
                    <h3 class="mb-3">Edit note</h3>
                    <form method="POST" action="{{ route('notes.update',$note) }}">
                        @method('put')
                        @csrf
                        <input  id="title" type="text" placeholder="Note Title" class="form-control mb-3"  name="title" value="{{old('title',$note->title)}}" autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                        {{--<div id="toolbar-container"></div>
                        <div style="border: 1px solid lightgray" id="text">{!!old('text',$note->text)!!}</div>--}}
                        <textarea class="form-control" name="text" id="text" rows="10" placeholder="Start typing here..." >{{old('text',$note->text)}}</textarea>
                        @error('text')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="form-group mt-3 row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
    {{--<script>
        DecoupledEditor
            .create( document.querySelector( '#text' ) )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>--}}
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
@endsection
