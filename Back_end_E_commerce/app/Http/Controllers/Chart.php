<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Coupon;


class Chart extends Controller
{
    //
    public function sales(){
        // $data=Product::select('id','created_at')->get()->groupBy(function($data){
        //    return Carbon::parse($data->created_at)->format('M');
        // });
        // $months=[];
        // $monthCount=[];
        // foreach($data as $month => $values){
        //     $months[]=$month;
        //     $monthCount[]=count($values);
        // }
        // return view('sales',['data'=>$data,'months'=>$months,'monthCount'=>$monthCount]);

        $product_active = Product::where('status', 1)->count();
        $product_inactive = Product::where('status', 0)->count();
        return view('sales',['product_active' => $product_active, 'product_inactive' => $product_inactive]);
    
    }
    public function customer(){
        $customer_active = User::where('status', 1)->count();
        $customer_inactive = User::where('status', 0)->count();
        return view('customer',['customer_active' => $customer_active, 'customer_inactive' => $customer_inactive]);
    
    }
    public function chartCoupons(){
         $coupon_active = Coupon::where('status', 1)->count();
        $coupon_inactive = Coupon::where('status', 0)->count();
        return view('chartCoupon',['coupon_active' => $coupon_active, 'coupon_inactive' => $coupon_inactive]);
    
    }

}
