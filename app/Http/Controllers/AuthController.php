<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'email'         => 'required|email|unique:users',
                'password'      => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->url_site)
            ]);

            $user->save();

            return response()->json([
                'message' => 'Successfully created user!'], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: the user was not created.'], 412);
        }
    }

    /**
     * Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email'         => 'required|email',
                'password'      => 'required'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $credentials = request(['email', 'password']);

            if(!Auth::attempt($credentials)){
                throw new \Exception();
            }

            $user = User::Where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Successfully access!',
                'access_token' => $tokenResult,
                'rol' => $user->roles->first()->name ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: unauthorized access.'], 401);
        }
    }

    /**
     * Logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out.'], 200);
    }
}
