<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gspace;
use Illuminate\Support\Facades\Validator;

class GspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Gspace::where("user_id", auth()->user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
         $fields = Validator::make($request->all(), [// Validate the incoming request data
            "date" => "required|date",
            "time" => "required",
            "room" => "required",
        ]);

        if ($fields->fails()) {// If validation fails, return the validation errors
            return response()->json(["Booking error" => $fields->errors()], 422);
        }

        $gspace = new Gspace();// Create a new Gspace instance and fill it with the validated data
        $gspace->user_id = auth()->user()->id;
        $gspace->date = $request->input("date");
        $gspace->time = $request->input("time");
        $gspace->room = $request->input("room");
    
        $gspace->save();// Save the Gspace instance to the database

        return response()->json(["message" => "Booking created successfully"], 201);// Return a response indicating success

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gspace = Gspace::where("user_id", auth()->user()->id)->where("id", $id)->first();

        if (!$gspace) {
            return [
                "message" => "Booking not found"
            ];
        }

        return $gspace;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
