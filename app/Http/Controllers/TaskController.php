<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $task = task::all();
        return view('task.index', compact('task'));
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,in-progress,done',
            'complited' => 'boolean',
        ]);

        Task::create($validated);

        return redirect()->route('task.index')
            ->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,in-progress,done',
            'complited' => 'boolean',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'complited' => $request->boolean('complited'),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

}
