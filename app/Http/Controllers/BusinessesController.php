<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusinessesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function index($user)
    {
        try {
            $user = User::find($user);
            if(empty($user)){
                return response()->json(['message' => 'Error: User were not found.'], 412);
            }

            if(Gate::allows('generic-administration')){
                $business = Business::where('user_id', $user->getKey())->get();
                return response()->json(['Business' => $business], 200);
            }else{
                $business = Business::where('user_id', Auth::id())->get();
                return response()->json(['Business' => $business], 200);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: Business were not found.'], 412);
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
     * @param  int  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    {
        try{
            $validator = Validator::make($request->all(), [
                'business_name'     => 'required|string|max:255',
                'rut'               => 'required|cl_rut',
                'address'            => 'required|string|max:255',
                'phone'             => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'email'             => 'required|string|email|max:255',
                'user_id'           => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $business = new Business([
                'business_name'     => $request->business_name,
                'rut'               => $request->rut,
                'address'            => $request->address,
                'phone'             => $request->phone,
                'email'             => $request->email,
                'user_id'           => $request->user_id
            ]);

            $business->save();

            return response()->json([
                'id' => $business->id,
                'message' => 'Successfully created Business!'
            ], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The Business was not created.'], 412);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @param  int  $business_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $business_id)
    {
        try {
            $user = User::find($user_id);
            if(empty($user)){
                return response()->json(['message' => 'Error: User were not found.'], 412);
            }

            if(Gate::allows('generic-administration')){
                $business = Business::where('id', $business_id)->where('user_id', $user_id)->get();
                return response()->json(['Business' => $business], 200);
            }else{
                $business = Business::where('id', $business_id)->where('user_id', Auth::id())->get();
                return response()->json(['Business' => $business], 200);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The Business was not found.'], 412);
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
    public function update(Request $request, $user_id, $business_id)
    {
        try {
            $user = User::find($user_id);
            if(empty($user)){
                return response()->json(['message' => 'Error: User were not found.'], 412);
            }

            $business = Business::find($business_id);
            if(empty($business)){
                return response()->json(['message' => 'Error: Business were not found.'], 412);
            }

            if(Gate::allows('update-business')){
                $validator = Validator::make($request->all(), [
                    'business_name'     => 'required|string|max:255',
                    'rut'               => 'required|cl_rut',
                    'address'            => 'required|string|max:255',
                    'phone'             => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                    'email'             => 'required|string|email|max:255',
                    'user_id'           => 'required'
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 412);
                }

                $business->fill([
                    'business_name' => $request->business_name,
                    'rut'           => $request->rut,
                    'address'        => $request->address,
                    'phone'         => $request->phone,
                    'email'         => $request->email,
                    'user_id'       => $request->user_id
                ]);

                $business->save();

                return response()->json(['message' => 'Successfully updated Business!'], 201);
            }else{
                $validator = Validator::make($request->all(), [
                    'business_name'     => 'required|string|max:255',
                    'rut'               => 'required|cl_rut',
                    'address'            => 'required|string|max:255',
                    'phone'             => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                    'email'             => 'required|string|email|max:255',
                    'user_id'           => 'required'
                ]);

                if($validator->fails()) {
                    return response()->json($validator->errors(), 412);
                }

                $business->fill([
                    'business_name' => $request->business_name,
                    'rut'           => $request->rut,
                    'address'        => $request->address,
                    'phone'         => $request->phone,
                    'email'         => $request->email,
                    'user_id'       => Auth::id()
                ]);

                error_log($business);
                $business->save();
                return response()->json(['message' => 'Successfully updated Business!'], 201);
            }
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Error: The Business was not update.'], 412);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_id
     * @param  int  $business_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $business_id)
    {
        try {
            // $user = User::find($user_id);
            // if(empty($user)){
            //     return response()->json(['message' => 'Error: User were not found.'], 412);
            // }

            // $business_ = Business::find($business_id);
            // if(empty($business_)){
            //     return response()->json(['message' => 'Error: User were not found.'], 412);
            // }

            if(Gate::allows('delete-business')){
                $business = Business::where('id', $business_id)->where('user_id', $user_id);
                $business->delete();
                return response()->json(['message' => 'Successfully deleted Business!'], 201);
            }else{
                $business = Business::where('id', $business_id)->where('user_id', Auth::id());
                $business->delete();
                return response()->json(['message' => 'Successfully deleted Business!'], 201);
            }
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Error: The Business was not found.'], 412);
        };
    }
}
