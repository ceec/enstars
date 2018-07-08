<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Auth;
use App\Message;

use App\Mail\Contact;

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

            Mail::to('info@enstars.info')->send(new Contact($request));
    
        }



        return view('pages.contactThankYou');
      }


}
