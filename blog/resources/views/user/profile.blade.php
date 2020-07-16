@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboarh') }}</div>

                <div class="card-body">
                    <a href="{{ route('home') }}">{{ __('Home') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="user-profile-img">
                                <span class="update-avatar">Update avatar</span>
                                <h3 class="user-profile-name">{{ Auth::user()->full_name }}</h3>
                                <p class="user-profile-gender">{{ Auth::user()->display_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs nav-fill">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">User information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Others information</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr class="row user-information-detail">
                                                    <td class="col-md-3">Name</td>
                                                    <td class="col-md-9">{{ Auth::user()->full_name }}</td>
                                                </tr>

                                                <tr class="row user-information-detail">
                                                    <td class="col-md-3">Display name</td>
                                                    <td class="col-md-9">{{ Auth::user()->display_name }}</td>
                                                </tr>

                                                <tr class="row user-information-detail">
                                                    <td class="col-md-3">Birthday</td>
                                                    <td class="col-md-9">{{ Auth::user()->birthday }}</td>
                                                </tr>

                                                <tr class="row user-information-detail">
                                                    <td class="col-md-3">Phone number</td>
                                                    <td class="col-md-9">{{ Auth::user()->phone_number }}</td>
                                                </tr>

                                                <tr class="row user-information-detail">
                                                    <td class="col-md-3">Address</td>
                                                    <td class="col-md-9">{{ Auth::user()->address }}</td>
                                                </tr>

                                                <tr class="row user-information-detail">
                                                    <td class="col-md-3">Email Address</td>
                                                    <td class="col-md-9">{{ Auth::user()->email }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-edit">
                                        <a href="{{ route('edit', Auth::user()->id) }}">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
