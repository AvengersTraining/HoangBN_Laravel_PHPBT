@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Tag') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tags.update', $tag->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="tag_name" class="col-md-4 col-form-label text-md-right">{{ __('Tag name') }}</label>

                            <div class="col-md-6">
                                <input id="tag_name" type="text" class="form-control @error('tag_name') is-invalid @enderror" name="tag_name" value="{{ $tag->tag_name }}" autocomplete="tag_name" autofocus>

                                @error('tag_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
