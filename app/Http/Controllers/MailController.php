<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Auth;


class MailController extends Controller
{

    /**
     * Send contact us email
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSend(Request $request) {

        
        if ($request->enstars == '') {

            //save who submitted it
            if (!Auth::guest()) {
                $submitted_by =  Auth::id();  
            } else {
                $submitted_by = 0;
            }


            $m = new Message;
            $m->name = $request->name;
            $m->email = $request->email;
            $m->message = $request->message;
            $m->submitted_by = $submitted_by;
            $m->updated_by = 0;
            $m->save();  

            $to = 'info@enstars.info';
            $subject = "enstars.info - New Message from ".$request->name;
            $message = $request->message;
            $headers = 'From: '.$request->email;     

            //Mail::to($to)->send(new OrderShipped($order));

            //mail($to,$subject,$message,$headers);
            Mail::raw($message, function($message){
                $message->from($request->email, $subject);

                $message->to($to);
            });
    
        }



        return view('pages.contactThankYou');
      }


}
