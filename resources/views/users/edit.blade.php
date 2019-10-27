@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card card-header">My Profile</div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{route('users.update-profile')}}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input  class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea cols="5"  rows="5" class="form-control" type="text" name="about" id="about">{{$user->about}}</textarea>
                </div>

                <button class="btn btn-success" type="submit">Update Profile</button>
            </form>
        </div>
@endsection
