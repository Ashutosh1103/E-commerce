<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;

class Website extends Controller
{
    //
    public function index(){
        Mail::send('mail',$data,function($messages) use ($user){
            $messages->to('ashutoshmulay4@gmail.com');
            $messages->subject('Hello');
        });
    }
}
