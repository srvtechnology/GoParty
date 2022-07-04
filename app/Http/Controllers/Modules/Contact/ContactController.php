<?php

namespace App\Http\Controllers\Modules\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Mail;
use App\Mail\ContactMail;
class ContactController extends Controller
{
    public function submit(Request $request)
    {
    	$contact  = new Contact;
    	$contact->first_name = $request->first_name;
    	$contact->last_name = $request->last_name;
    	$contact->phone_number = $request->phone_number;
    	$contact->email = $request->email;
    	$contact->comment = $request->comment;
    	$contact->save();
    	$data = [
                'email'=>$request->email,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone_number'=>$request->phone_number,
                'comment'=>$request->comment,
        ];
        Mail::send(new ContactMail($data));
        return redirect()->back()->with('success','Thanks for contacing us.We will get back to you soon.');
    }
}
