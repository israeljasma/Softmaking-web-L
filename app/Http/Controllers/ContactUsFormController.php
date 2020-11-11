<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;
use Mail;

class ContactUsFormController extends Controller {

    // Create Contact Form
    public function createForm(Request $request) {
      return view('mails.contact');
    }

    // Store Contact Form data
    public function ContactUsForm(Request $request) {

        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject'=>'required',
            'message' => 'required'
         ]);

        //  Store data in database
        Contact::create($request->all());

        //  Send mail to admin
        \Mail::send('mails.mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'subject' => $request->get('subject'),
            'user_query' => $request->get('message'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('contacto@softmaking.cl', 'contacto')->subject($request->get('subject'));
        });
        return redirect('/')->with('success', 'Muchas gracias por contar con nosotros. Trataremos de comunicarnos con usted a la brevedad después de analizar su petición u otro caso.');
    }

}