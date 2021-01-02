<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response()->json(Client::all(), 200);
        try {
            $client = Client::all();

            return response()->json($client, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: Client were not found.'], 412);
        }
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
                'name'          => 'required',
                'description'   => 'required',
                'url_logo'          => 'required',
                'url_site'          => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $client = new Client([
                'name' => $request->name,
                'description' => $request->description,
                'url_site' => $request->url_site,
            ]);

            if($request->file('url_logo')){
                $file=$request->file('url_logo');
                $random = Str::random(40);
                $fileName = $random.'.'.$file->getClientOriginalExtension();
                $request->file('url_logo')->storeAs('public',$fileName);
                $client->url_logo = $fileName;       
            }else{
                return response()->json(['message' => 'Error: The client was not created.'], 412);
            }

            $client->save();

            return response()->json([
                'message' => 'Successfully created client!',
                'data' => $client->toArray()
            ], 201);

            }catch(\Exception $exception){
                return response()->json(['message' => 'Error: The client was not created.'], 412);
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
            $client = Client::findOrFail($id);

            return response()->json($client, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The client was not found.'], 412);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'description'   => 'required',
                'url_site'      => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $client = Client::findOrFail($id);

            $client->fill([
                'name' => $request->name,
                'description' => $request->description,
                'url_site' => $request->url_site,
            ]);

            if($request->hasfile('url_logo')){
                $file=$request->file('url_logo');
                $random = Str::random(40);
                $fileName = $random.'.'.$file->getClientOriginalExtension();
                $request->file('url_logo')->storeAs('public',$fileName);
                Storage::delete('public/'.$client->file);
                $client->file = $fileName;
            }

            // if($request->file){
            //     $file=$request->file('url_logo');
            //     $random = Str::random(40);
            //     $fileName = $random.'.'.$file->getClientOriginalExtension();
            //     $request->file('url_logo')->storeAs('public',$fileName);
            //     Storage::delete('public/'.$client->file);
            //     $client->file = $fileName;
            // }
            // else{
            //     return response()->json(['message' => 'Error: The cligbfdgfdgfdgdfpdated.'], 412);
            // }

            // if($request->hasfile('url_logo')){
            //     return response()->json(['message' => 'Entro al if','data' => $client->toArray()], 412);
            // }else{
            //     return response()->json(['message' => 'Todo se jodio','data' => $client->toArray()], 412);
            // }
            

            $client->save();

            return response()->json([
                'message' => 'Successfully updated client!',
                'data' => $client->toArray()
            ], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The client was not updated.'], 412);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            if($client->delete()){
                return response()->json([
                    'message' => 'Successfully deleted client!'], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The client was not deleted.'], 412);
        }
    }

    // /**
    //  * Search a specific element the listing of the resource.
    //  *
    //  * @param  string  $name
    //  * @return \Illuminate\Http\Response
    //  */
    // public function search($name)
    // {
    //     return response()->json(Client::where("name", "like", "%".$name."%")->get(), 200);
    //     try {
    //         $client = Client::all();

    //         return response()->json($client, 200);
    //     } catch (\Exception $exception) {
    //         return response()->json([
    //             'message' => 'Error: Client were not found.'], 412);
    //     }
    // }
}
