<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'ticket_id' => 'required|numeric',
                'comment'   => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            // cualquier usuario admin
            if(Gate::allows('generic-administration')){
                $comment = new Comment([
                    'ticket_id' => $request->input('ticket_id'),
                    'user_id'    => Auth::user()->id,
                    'comment'    => $request->input('comment'),
                ]);

                $comment->save();
                
                // send mail if the user commenting is not the ticket owner
                // if ($comment->ticket->user->id !== Auth::user()->id) {
                //     $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
                // }

                return response()->json([
                    'message' => 'Successfully created comment!',
                    'comment' => $comment
                ], 201);
            }else{
                // Verifica que sea el usuario logueado sea el solicitante si este no es admin
                $var = Ticket::where('id', $request->ticket_id)->where('user_id', Auth::user()->id)->get();
                if(!$var->isEmpty()){
                    $comment = new Comment([
                        'ticket_id' => $request->input('ticket_id'),
                        'user_id'    => Auth::user()->id,
                        'comment'    => $request->input('comment'),
                    ]);

                    $comment->save();

                    // send mail if the user commenting is not the ticket owner
                    // if ($comment->ticket->user->id !== Auth::user()->id) {
                    //     $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
                    // }

                    return response()->json([
                        'message' => 'Successfully created comment!',
                        $comment
                    ], 200);
                }

                return response()->json(['message' => 'Error: The comment was not created.',], 412);
            }
        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The comment was not created.'], 412);
        }
        // send mail if the user commenting is not the ticket owner
        // if ($comment->ticket->user->id !== Auth::user()->id) {
        //     $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
