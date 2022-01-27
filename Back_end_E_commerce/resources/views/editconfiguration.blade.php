@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <form method="POST" action="/configuration/{{$data->id}}">
        <h2 class="text-center text-primary">User</h2>
        @csrf()
        @method('PUT')
       
        <div class="row form-group m-auto col-5">
            Email <input type="email" class="form-control" name="email" value="{{$data->email}}" />
            @if($errors->has('email'))
            <label class="text-danger">{{$errors->first('email')}}</label>
            @endif
        </div>
       
        <input type="hidden" value="{{$data->id}}" name="uid" />
        <div class="text-center mt-2">
            <input type="submit" class="btn btn-success" value="submit" />
        </div>
    </form>

</div>
@endsection