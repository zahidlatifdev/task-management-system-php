<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::where('completed', false)->orderBy('priority','desc')->orderBy('due_date')->get();
        
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|max:255',
            'organization_id' => 'sometimes|integer',
        ]);        

        $taskData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
            'user_id' => $request->user()->id,
        ];
        if($request->input('organization_id') !== null){
            $taskData['organization_id'] = $request->input('organization_id');
        }
        Task::create($taskData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');

    }

    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|max:255',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function complete(Task $task)
    {
        $task->update([
            'completed' => true,
            'completed_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task completed successfully!');
    }

    public function showCompleted()
    {
        $completedTasks = Task::where('completed', true)->orderBy('completed_at', 'desc')->get();

            return view('tasks.show', compact('completedTasks'));
    }
}
