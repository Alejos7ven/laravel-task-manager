<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use App\Models\Todo;
use App\Models\Category; 

class TodoController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title'=>'required|min:3'
        ]);
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();
        return redirect()->route('tasks')->with("success","Created successfully");
    }
    public function index() {
        $todos = Todo::all();
        $categories = Category::all();
        return view('tasks.index', ['todos' => $todos, 'categories'=> $categories]);
    }
    public function show($id) {
        $todos = Todo::find($id);
        return view('tasks.show', ['todos' => $todos]);
    }
    public function update(Request $request, $id) {
        $todos = Todo::find($id);
        $todos -> title = $request->title;
        $todos->save(); 
        return redirect()->route('tasks')->with("success","Task updated!");
    }
    public function destroy($id) {
        $todos = Todo::find($id);
        $todos->delete();
        return redirect()->route('tasks')->with("success","Task deleted!");
    }
}
