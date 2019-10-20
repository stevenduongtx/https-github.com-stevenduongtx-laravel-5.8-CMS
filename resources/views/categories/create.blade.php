@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card card-header">
            {{isset($category)?'Update Category':'Create Category'}}
        </div>
        <div class="card card-body">
            @include('partials.error')

            <form action="{{isset($category)? route('categories.update',$category->id):route('categories.store')}}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{isset($category)?$category->name : ''}}">
                </div>
                <div class="form-group">
                   <button class="btn btn-success">{{isset($category)?'Edit':'Add'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
