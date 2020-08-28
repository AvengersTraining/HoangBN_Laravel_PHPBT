@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" id="followings" href="#">{{ __('Drafts') }}</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" id="newest" href="#">{{ __('Public') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div></div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Type') }}</div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
