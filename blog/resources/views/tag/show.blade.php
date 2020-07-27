@extends('layouts.app')

@section('content')
<div class="container">
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
                <div class="card-header">{{ __('Tag Detail') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr class="row margin-zero">
                                    <td class="col-md-3">Tag Name</td>
                                    <td class="col-md-9">{{ $tag->tag_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="edit-button-right">
                        <a href="{{ route('tags.edit', $tag->id) }}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
