<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('page')->with('todos', Todo::all());
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]); 

        $todo = new Todo;
        $todo->name = $request->name;
        $todo->save();

        return $this->index();
    }

    
    public function delete($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $todo->delete();
             return $this->index();
        }

        
    }

    public function complete($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $todo->completed = !$todo->completed; 
            $todo->save();
             return $this->index();
        }

        return $this->index();
    }
}
