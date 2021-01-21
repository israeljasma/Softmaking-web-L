<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\InvoiceDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Gate;
use Illuminate\Support\Facades\Validator;

class invoicesDocumentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $user = User::find($id);
            if(empty($user)){
                return response()->json(['message' => 'Error: User were not found.'], 412);
            }

            if(Gate::allows('generic-administration')){
                
                $invoices = InvoiceDocument::where('user_id', $user->getKey())->get();
                return response()->json(['invoices' => $invoices], 200);
            }else{
                
                $invoices = InvoiceDocument::where('user_id', Auth::id())->get();
                return response()->json(['invoices' => $invoices], 200);
            }    
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: invoice were not found.'], 412);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        // return view('admin.invoices.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        try{
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'description'   => 'required',
                'date'          => 'required',
                'file'          => 'required|mimes:pdf'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $invoice = new InvoiceDocument([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
            ]);

            if($request->file('file')){
                $file=$request->file('file');
                $random = Str::random(40);
                $fileName = $random.'.'.$file->getClientOriginalExtension();
                $request->file('file')->storeAs('public',$fileName);
                $invoice->file = $fileName;
            }else{
                return response()->json(['message' => 'Error: The invoice was not created.'], 412);
            }
            $invoice->user_id = $user->id;

            $invoice->save();

            return response()->json(['message' => 'Successfully created invoice!'], 201);

            }catch(\Exception $exception){
                return response()->json(['message' => 'Error: The invoice was not created.'], 412);
            }



        // $this->validate($request, [
        //     'name'          => 'required',
        //     'description'   => 'required',
        //     'date'          => 'required',
        //     'file'          => 'required|mimes:pdf'
        // ]);
        // $data = new InvoiceDocument;
        // if($request->file('file')){
        //     $file=$request->file('file');
        //     $random = Str::random(40);
        //     $fileName = $random.'.'.$file->getClientOriginalExtension();
        //     $request->file('file')->storeAs('public',$fileName);
        //     $data->file = $fileName;            
        // }

        // $data->name=$request->name;
        // $data->description=$request->description;
        // $data->date=$request->date;
        // $data->user_id=$user->id;

        // $data->save();

        // $invoices = InvoiceDocument::where('user_id', $user->getKey())->get();

        // return redirect()->route('admin.invoices.index', [$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceDocument  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, InvoiceDocument $invoice)
    {
        try {
            if(!User::findOrFail($user->id)){
                return response()->json(['message' => 'Error: Users were not found.'], 412);
            }

            if(Gate::allows('generic-administration')){
                
                $invoice = InvoiceDocument::with('user')->where('id', $invoice->id)->where('user_id', $user->id)->get();
                return response()->json(['invoice' => $invoice], 200);
            }else{
                
                // $invoices = InvoiceDocument::where('user_id', Auth::id())->get();
                // return response()->json(['invoices' => $invoices], 200);
                $invoice = InvoiceDocument::with('user')->where('id', $invoice->id)->where('user_id', Auth::id())->get();
                return response()->json(['invoice' => $invoice], 200);
            }            
            // if(empty($invoice)){
            //     return response()->json(['message' => 'Error: Users were not found.'], 412);
            // }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The client was not found.'], 412);
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceDocument  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, InvoiceDocument $invoice)
    {
        try {
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }
            if(!User::findOrFail($user->id)){
                return response()->json(['message' => 'Error: Users were not found.'], 412);
            }
            
            $invoice = InvoiceDocument::with('user')->where('id', $invoice->id)->where('user_id', $user->id)->get();
            
            if(!$invoice){
                return response()->json(['message' => 'Error: Users were not found.'], 412);
            }

            return response()->json(['user' => $user, 'invoices' => $invoice], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The client was not found.'], 412);
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @param  \App\InvoiceDocument  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, InvoiceDocument $invoice)
    {
        try{
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'description'   => 'required',
                'date'          => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }
            
            $invoice = InvoiceDocument::findOrFail($invoice->id);

            $invoice->fill([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
            ]);

            //error_log('antes del if!!!!!');
            if($request->hasfile('file')){
                $file=$request->file('file');
                $random = Str::random(40);
                $fileName = $random.'.'.$file->getClientOriginalExtension();
                $request->file('file')->storeAs('public',$fileName);
                Storage::delete('public/'.$invoice->file);
                $invoice->file = $fileName;
            }
            //if($request->file('file')){
              //  error_log("llega aqui???????");
                //$file=$request->file('file');
                //$random = Str::random(40);
                //$fileName = $random.'.'.$file->getClientOriginalExtension();
                //$request->file('file')->storeAs('public',$fileName);
                //$invoice->file = $fileName;       
            //}else{
                //return response()->json(['message' => 'Error: The invoice was not created.'], 412);
            //}

            //error_log("Se paso el if!!!!!!!!");
            //$invoice->save();

            // $invoices = InvoiceDocument::with('user')->where('user_id', $user->getKey())->get();

            return response()->json(['message' => 'Successfully updated invoice!'], 200);

            }catch(\Exception $exception){
                return response()->json(['message' => 'Error: The invoice was not created.'], 412);
            }

        // $invoiceUser = InvoiceDocument::find($invoice->id);
        // if($request->file){
        //     $file=$request->file('file');
        //     $random = Str::random(40);
        //     $fileName = $random.'.'.$file->getClientOriginalExtension();
        //     $request->file('file')->storeAs('public',$fileName);
        //     Storage::delete('public/'.$invoiceUser->file);
        //     $invoiceUser->file = $fileName;
        // }
        // $invoiceUser->name=$request->name;
        // $invoiceUser->description=$request->description;
        // $invoiceUser->date=$request->date;
        // $invoiceUser->user_id=$user->id;

        // $invoiceUser->save();
        
        // return redirect()->route('admin.invoices.index',['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @param  \App\InvoiceDocument  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, InvoiceDocument $invoice)
    {
        try {
            if(Gate::denies('delete-invoices')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            if(!User::findOrFail($user->id)){
                return response()->json(['message' => 'Error: Users were not found.'], 412);
            }
            
            $invoice = InvoiceDocument::where('id', $invoice->id)->where('user_id', $user->id)->get();
            
            if(!$invoice){
                return response()->json(['message' => 'Error: Users were not found.'], 412);
            }

            //$invoice = InvoiceDocument::find($invoice->id);
            Storage::delete('public/'.$invoice->file);
            $invoice->delete();

            return response()->json([
                'message' => 'Successfully deleted invoice!'], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The invoice was not found.'], 412);
        };



        // if(Gate::denies('delete-invoices')){
        //     return redirect()->route('home');
        // }

        // $invoice = InvoiceDocument::find($invoice->id);
        // Storage::delete('public/'.$invoice->file);
        // $invoice->delete();
        
        // $invoices = InvoiceDocument::all();
        // return redirect()->route('admin.invoices.index', ['user' => $user]);
        
        
        //dd(Storage::delete('storage/app/public/'.$invoice->file));
        //dd($files = Storage::files('public'));
        
        //dd($files = Storage::files('public'));
        // if(Storage::exists($invoice->file)){

        //     \Storage::delete('/public/storage'.$invoice->file);
        
        //   }else{
        
        //     dd('File does not exists.');
        //     //dd($invoice->file);
        
        //   }
    }

    // public function indexUser(){

    //     $invoices = InvoiceDocument::where('user_id', Auth::id())->get();
    //     return view('user.invoices.index', compact('invoices'));
    // }

    // public function showUser(InvoiceDocument $invoice)
    // {
    //     $invoiceUser = InvoiceDocument::find($invoice->id);
    //     return view('user.invoices.show', compact('invoiceUser'));
    // }


    // public function downloaddd(User $user, InvoiceDocument $invoice)
    // {
    //     //dd($invoice);
    //     $url = Storage::temporaryUrl(
    //         $invoice->file, now()->addMinutes(5)
    //     );

    //     return $url;
    // }
}
