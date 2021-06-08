<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        // return view('admin.users.index')->with('users', $users);
        try {
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $users = User::all();

            return response()->json($users, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: Users were not found.'], 412);
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
        try {
            if(Gate::denies('create-users')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|max:255',
                'lastname'      => 'required|string|max:255',
                'phone'         => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'email'         => 'required|string|email|max:255|unique:users',
                'password'      => 'required|string|min:8|confirmed'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $user = new User([
                'name'      => $request->name,
                'lastname'  => $request->lastname,
                'phone'     => $request->phone,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'active'    => True
            ]);

            $user->save();

            $role = Role::select('id')->where('name', 'Cliente')->first();

            $user->roles()->attach($role);

            return response()->json([
                'message' => 'Successfully created user!'], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: Users were not found.'], 412);
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
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }
            
            $user = User::findOrFail($id);

            return response()->json($user, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The user was not found.'], 412);
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
        try{
            if(Gate::denies('edit-users')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $user = User::findOrFail($id);
            $roles = Role::all();

            return response()->json([
                'user' => $user->roles, 
                'roles' => $roles
            ], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The client was not found.'], 412);
        }
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
            if(Gate::denies('edit-users')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'lastname'      => 'required|string|max:255',
                'phone'         => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'roles'         => 'required|numeric',
                'email'         => 'required|string|email|max:255', Rule::unique('users')->ignore(Auth::id(), 'id'),
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $roles = Role::findOrFail($request->roles);
            $user = User::findOrFail($id);

            $user->roles()->sync($request->roles);
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();


            return response()->json([
                'message' => 'Successfully updated user!',
                'user' => $user->roles, 
                'user_rol' => $roles
            ], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The user was not updated.'], 412);
        }

        //sync si fuese un array(por si las moscas)
        // $user->roles()->sync($request->roles);
        // $user->name = $request->name;
        // $user->email = $request->email;

        // if($user->save()){
        //     $request->session()->flash('success',$user->name. ' has been update');
        // }else{
        //     $request->session()->flash('error','There was an error updating the user');
        // }

        // return redirect()->route('admin.users.index');
        //dd($request);
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
            if(Gate::denies('delete-users')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $user = User::findOrFail($id);

            $user->roles()->detach();
            $user->delete();

            return response()->json([
                'message' => 'Successfully deleted user!'], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The user was not deleted.'], 412);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        try {
            $user = User::findOrFail(Auth::id());

            return response()->json($user, 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Error: The user was not found.'], 412);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'lastname'      => 'required|string|max:255',
                'phone'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'email'         => 'required|string|email|max:255', Rule::unique('users')->ignore(Auth::id(), 'id')
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $user = User::findOrFail(Auth::id());

            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();

            return response()->json(['message' => 'Successfully updated user profile!'], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The user profile was not updated.'], 412);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'password'      => 'required|string|min:8|confirmed'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $user = User::findOrFail(Auth::id());

            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json(['message' => 'Successfully updated password!'], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The password was not updated.'], 412);
        }
    }
}
