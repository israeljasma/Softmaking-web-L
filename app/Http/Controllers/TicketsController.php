<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\Ticket;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if(Gate::allows('generic-administration')){
                
                $tickets = Ticket::all();
                return response()->json($tickets, 200);
            }else{
                
                $tickets = Ticket::where('user_id', Auth::id())->get();
                return response()->json($tickets, 200);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: ticket were not found.'], 412);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            
            $categories = Category::all();
            return response()->json($categories, 200);
            
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: categories were not found.'], 412);
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
            $validator = Validator::make($request->all(), [
                'title'     => 'required',
                'category'  => 'required|numeric',
                'priority'  => 'required',
                'message'   => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $ticket = new Ticket([
                'title'     => $request->input('title'),
                'user_id'   => Auth::user()->id,
                'ticket_id' => strtoupper(Str::random(10)),
                'category_id'   => $request->input('category'),
                'priority'  => $request->input('priority'),
                'message'   => $request->input('message'),
                'status'    => "Abierto"
            ]);

            $ticket->save();

            return response()->json([
                'message' => 'Successfully created ticket!',
                // 'ticket' => $ticket
            ], 200);

            }catch(\Exception $exception){
                return response()->json(['message' => 'Error: The client was not created.'], 412);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        try {
            // cualquier usuario admin
            if(Gate::allows('generic-administration')){
                
                $ticket = Ticket::find($ticket->id);
                $comments = $ticket->comments;
                return response()->json([
                    'ticket'    => $ticket,
                    'category'  => $ticket->category,
                    'comments' => $comments
                ], 200);
            }else{
                // Verifica que sea el usuario logueado el solicitante si este no es admin
                $tickets = Ticket::where('user_id', Auth::id())->get();
                $comments = $ticket->comments;
                error_log($tickets);
                return response()->json([
                    'ticket'    => $ticket,
                    'category'  => $ticket->category,
                    'comments' => $comments
                ], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: ticket were not found.'], 412);
        }

        $ticket = Ticket::find($ticket->id);
        
        $comments = $ticket->comments;

        return view('tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
