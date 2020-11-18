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

class invoicesDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $invoices = InvoiceDocument::where('user_id', $user->getKey())->get();
        return view('admin.invoices.index', compact('invoices'))->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('admin.invoices.create')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //dd($user);
        $data = new InvoiceDocument;
        if($request->file('file')){
            $file=$request->file('file');
            $random = Str::random(40);
            $fileName = $random.'.'.$file->getClientOriginalExtension();
            $request->file('file')->storeAs('public',$fileName);
            $data->file = $fileName;            
        }

        $data->name=$request->name;
        $data->description=$request->description;
        $data->date=$request->date;
        $data->user_id=$user->id;

        $data->save();

        $invoices = InvoiceDocument::where('user_id', $user->getKey())->get();
        return view('admin.invoices.index', compact('invoices'))->with('user', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, InvoiceDocument $invoice)
    {
        $invoiceUser = InvoiceDocument::find($invoice->id);
        return view('admin.invoices.show', compact('invoiceUser'))->with('user', $user);
        //return view('admin.invoices.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, InvoiceDocument $invoice)
    {
        if(Gate::denies('edit-invoices')){
            return redirect()->route('home');
        }
        $invoiceUser = InvoiceDocument::find($invoice->id);
        return view('admin.invoices.edit', compact('invoiceUser'))->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, InvoiceDocument $invoice)
    {
        $invoiceUser = InvoiceDocument::find($invoice->id);
        if($request->file){
            $file=$request->file('file');
            $random = Str::random(40);
            $fileName = $random.'.'.$file->getClientOriginalExtension();
            $request->file('file')->storeAs('public',$fileName);
            Storage::delete('public/'.$invoiceUser->file);
            $invoiceUser->file = $fileName;
        }
        $invoiceUser->name=$request->name;
        $invoiceUser->description=$request->description;
        $invoiceUser->date=$request->date;
        $invoiceUser->user_id=$user->id;

        $invoiceUser->save();
        
        return redirect()->route('admin.invoices.index',['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, InvoiceDocument $invoice)
    {
        if(Gate::denies('delete-invoices')){
            return redirect()->route('home');
        }

        $invoice = InvoiceDocument::find($invoice->id);
        Storage::delete('public/'.$invoice->file);
        $invoice->delete();
        
        $invoices = InvoiceDocument::all();
        return redirect()->route('admin.invoices.index', ['user' => $user]);
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

    public function indexUser(){

        $invoices = InvoiceDocument::where('user_id', Auth::id())->get();
        return view('user.invoices.index', compact('invoices'));
    }

    public function showUser(InvoiceDocument $invoice)
    {
        $invoiceUser = InvoiceDocument::find($invoice->id);
        return view('user.invoices.show', compact('invoiceUser'));
    }


    public function downloaddd(User $user, InvoiceDocument $invoice)
    {
        //dd($invoice);
        $url = Storage::temporaryUrl(
            $invoice->file, now()->addMinutes(5)
        );

        return $url;
    }
}
