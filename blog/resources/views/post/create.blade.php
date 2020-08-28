@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form action="{{ route('posts.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <div class="col-md-10">
                <input class="card post-title @error('title') is-invalid @enderror" type="text" name="title" autocomplete="off" placeholder="Title" value="{{ old('title') }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <br/>
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <input class="card post-tag @error('tags') is-invalid @enderror" name="tags" autocomplete="off" placeholder="Tag your post" value="{{ old('tags') }}">
                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Save
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item save-post" name="type" value="publish">Publish</button>
                                <button class="dropdown-item save-post" name="type" value="private">Private draft</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                
                <textarea class="card @error('content') is-invalid @enderror" name="content" id="editor" value="{{ old('content') }}"></textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('/js/simplemde.min.js') }}"></script>
<script src="{{ asset('/js/jQuery.tagify.min.js') }}"></script>
<script>
    var simpleMDE = new SimpleMDE({
        element : document.getElementById("editor"),
        spellChecker: false,
        autofocus: true,
	    autosave: {
            enabled: true,
            uniqueId: "editor",
            delay: 1000,
	    },
        tabSize: 4,
    });

    const oldEditorSetOption = simpleMDE.codemirror.setOption;
    simpleMDE.codemirror.setOption = function(option, value) {
        oldEditorSetOption.apply(this, arguments);

        if (option === 'fullScreen' && value == true) {
            $('.CodeMirror').css({height: 'unset'});
        }
    };

    $('.post-tag').tagify({
        whitelist : @json($tags),
        dropdown : {
            maxItems : 5,
        }
    });
</script>
@endsection
