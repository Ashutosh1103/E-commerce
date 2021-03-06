@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <form method="POST" action="/orders/{{$order->id}}" class=" form-group m-auto col-5">
        <h2 class="text-center text-primary">Order status</h2>
        @csrf()
        @method('put')
        <div class="card">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
                <h5 class="card-title"> Status</h5>
                <p class="card-text">
                <div class="container">

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="pending">Pending
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="completed">Completed
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="cancelled">Cancelled
                        </label>
                    </div>
                    @if($errors->has('status'))
                    <label class="text-danger">{{$errors->first('status')}}</label>
                    @endif
                </div>
                </p>
                <div class="text-center mt-2">
                    <input type="submit" class="btn btn-success" value="submit" />
                </div>
            </div>
        </div>


    </form>

</div>
@endsection