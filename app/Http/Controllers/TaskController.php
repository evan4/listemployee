<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $tasks = Task::paginate(5);

        return view('welcome', compact('tasks'));
    }

    public function store()
    {
        
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $task = Task::findOrFail((int)$data['id']);
    
        $res = $task->update($data);

        if($res){
            return response()->json([
                'data' => $data,
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail((int)$id);
        
        $res = $task->delete();

        if($res){
            return response()->json([
                'id' => $id,
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

}
