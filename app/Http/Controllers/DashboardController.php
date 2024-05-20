<?php

namespace App\Http\Controllers;

use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('complited', true)->count();
        $pendingTasks = Task::where('status', 'pending')->count();
        $inProgressTasks = Task::where('status', 'in-progress')->count();
        $doneTasks = Task::where('status', 'done')->count();

        $recentTasks = Task::latest()->take(5)->get();

        $taskStatusData = [
            'pending' => $pendingTasks,
            'inProgress' => $inProgressTasks,
            'done' => $doneTasks
        ];

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'taskStatusData',
            'recentTasks'
        ));
    }

}
