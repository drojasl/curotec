<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * List Todos
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Todo::all()->where('deleted', false));
    }

    /**
     * Store a newly Todo resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            // Get and validate the entered data
            $validatedData = $request->validate([
                'title' => 'required|string',
            ]);

            // Create Client object
            $client = new Todo();
            $client->title = $validatedData['title'];
            $client->save();
        
        } catch(\Exception $e) {
            return response()->json(['message' => 'Error trying to create todo', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Todo saved succesfully'], 201);
    }

    /**
     * Soft delete Todo from storage
     *
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        try {
            $todo = Todo::find($id);
            $todo->deleted = true;
            $todo->update();

        } catch(\Exception $e) {
            return response()->json(['message' => 'Error trying to delete todo', 'error' => $e->getMessage()], 500);
        }
        
        return response()->json(['message' => 'Todo deleted succesfully'], 201);
    }
}
