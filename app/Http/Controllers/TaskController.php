<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Task;
use App\Http\Requests\TaskRequest;

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('task.edit', compact('task'));
    }

    public function store(TaskRequest $request)
    {  
        Task::create($request->all());
        
        return redirect('home')->with('success', 'Новая задача была успешно добавлена!');
    }

    public function update(Request $request)
    {
        if(!$request->ajax()){
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'message' => 'required',
                'status' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect('home')
                            ->withErrors($validator)
                            ->withInput();
            }
        }

        $data = $request->all();
        $task = Task::findOrFail((int)$data['id']);
    
        $res = $task->update($data);

        if($res){
            if($request->ajax()){
                return response()->json([
                    'data' => $data,
                    'success' => true
                ]);
            }
            return redirect('home')->with('success', 'Задача была успешно Обновлена!');
        }
        if($request->ajax()){
            return response()->json([
                'success' => false
            ]);
        }
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
