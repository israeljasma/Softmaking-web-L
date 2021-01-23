<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;
use Mail;
use Gate;
use Illuminate\Support\Facades\Validator;

class ContactUsFormController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $contacts = Contact::orderByDesc('id')->get();

            return response()->json($contacts, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: Contact were not found.'], 412);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // Form validation
            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'email'     => 'required|email',
                'phone'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'subject'   => 'required',
                'message'   => 'required'
            ]);

            //  Store data in database
            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

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
                $message->to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->subject($request->get('subject'));
            });

            return response()->json(['message' => 'Muchas gracias por contar con nosotros. Trataremos de comunicarnos con usted a la brevedad después de analizar su petición u otro caso.'], 201);

            }catch(\Exception $exception){
                return response()->json(['message' => $exception->getMessage()], 412);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $contact = Contact::findOrFail($id);

            return response()->json($contact, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The contact was not found.'], 412);
        }
    }

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
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
