<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    public function create(Request $request){
        $user = Auth::user();
        $time = strval($request->time);
        $date = strval($request->date);
     
        $todo = $user->todo()->create([
            'title' => $request->title,
            'date' => $date,
            'time' => $time
        ]);
        // $todo = $user->todo()->save

        return response([
            'message' => 'successfull',
            'todo' => $todo
        ]);
    }
    public function destroyTodo(Request $request, $id){
        Todo::where('id', $id)->delete();
        return response([
            'message' => 'deleted'
        ]);
    }

    public function getAllTodos(Request $request){
        $user = Auth::user();
        $allTodos = Todo::where('user_id', $user->id)->get();
        return response([
            'user' => $user->name,
            'todos' => $allTodos
        ]);
    }

    public function updateTodo(Request $request,$id){
        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => 'date',
            'time' => 'time'
        ]);

        return response([
            'message' => 'updated'
        ]);
    }
}
