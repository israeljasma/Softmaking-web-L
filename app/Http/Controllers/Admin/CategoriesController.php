<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
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
            
            $category = Category::all();

            return response()->json($category, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: Cateories were not found.'], 412);
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
            if(Gate::denies('generic-administration')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|min:4'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $category = new Category([
                'name' => $request->name,
            ]);

            $category->save();

            return response()->json(['message' => 'Successfully created category!'], 201);

            }catch(\Exception $exception){
                return response()->json(['message' => 'Error: The category was not created.'], 412);
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

            $category = Category::findOrFail($id);

            return response()->json($category, 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The category was not found.'], 412);
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
            if(Gate::denies('manage-superadmin')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|min:4'
            ]);

            if($validator->fails()) {
                return response()->json($validator->errors(), 412);
            }

            $category = Category::findOrFail($id);

            $category->fill([
                'name' => $request->name
            ]);

            $category->save();

            return response()->json(['message' => 'Successfully updated category!'], 201);

        }catch(\Exception $exception){
            return response()->json(['message' => 'Error: The category was not updated.'], 412);
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
            if(Gate::denies('manage-superadmin')){
                return response()->json([
                    'message' => "Access denied. You don't have permission to access"], 403);
            }

            $category = Category::findOrFail($id);
            if($category->delete()){
                return response()->json([
                    'message' => 'Successfully deleted category!'], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error: The category was not deleted.'], 412);
        }
    }
}
