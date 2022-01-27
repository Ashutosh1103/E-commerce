@extends('layouts.app')
<style>
    .btnMargin {
        margin-left: 25%;
    }
</style>
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Management</h3>
                           </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                @if(Session::has('msg'))
                                <label>{{Session::get('msg')}}</label>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Booking ID</th>
                                        <th>Email</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Product Price</th>
                                        <th>Coupon Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sn=1;
                                    @endphp
                                    @foreach($data as $i)
                                    <tr>
                                    <td>{{$sn++}}</td>
                                        <td>{{$i->BookingId}}</td>
                                        <td>{{$i->email}}</td>
                                        <td>{{$i->product_name}}</td>
                                        <td>{{$i->product_price}}</td>
                                        <td>{{$i->product_quantity}}</td>
                                        <td>{{$i->coupon_code}}</td>
                                        <td>{{$i->amount}}</td>
                                        <td>{{$i->status}}</td>
                                       
                                        <td>
                                            <a href="/orders/{{$i->id}}/edit" class="btn btn-info">Edit</a>
                                        </td>
                                       
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection