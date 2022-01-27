<?php

namespace App\Http\Controllers;

use App\Models\User_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use DateTime;

class userOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = new DateTime();
        $result = $date->format('Y-m-d H:i:s');
        $orderid = mt_rand(10000, 999999);
        $data = User_order::insert([
            "email" => $request->email,
            "product_name" => $request->product_name,
            "product_price" => $request->product_price,
            "product_quantity" => $request->product_quantity,
            "product_image" => $request->product_image,
            "coupon_code" => $request->coupon_code,
            "amount" => $request->amount,
            "orderId" => $orderid,
            "BookingId" => $result
           ]);
        Mail::to($request->email)->send(new OrderMail($request->all()));
        return response()->json(["message" => "order placed successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = user_order::where('email', $id)->get();
        return response()->json(["orders" => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
