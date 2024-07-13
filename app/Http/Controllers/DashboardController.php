<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $projectCount = Project::where('user_id', Auth::id())->count();
        $projects = Project::where('user_id', Auth::id())
            ->orWhereHas('users', function ($query) {
                $query->where('users.id', Auth::id());
            })
            ->withCount('users')
            ->orderBy('project_end_date', 'desc')
            ->limit(4)
            ->get();
        $projectComplete = Project::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereHas('users', function ($query) {
                    $query->where('users.id', Auth::id());
                });
        })
            ->where('project_status', 'selesai')
            ->count();
        $taskComplete = Task::where('task_status', 'selesai')
            ->orderBy('task_end_date')
            ->with('modul')
            ->count();
        $tasks = Task::join('projects', 'tasks.project_id', '=', 'projects.id')
            ->whereHas('user', function ($query) use ($user) {
                $query->where('project_manager_id', $user->id);
            })
            ->select('tasks.*', 'projects.project_name')
            ->orderBy('task_end_date', 'desc')
            ->limit(10)
            ->get();


        return view('dashboard.mainmenu', compact('projects', 'tasks', 'projectCount', 'projectComplete', 'taskComplete'));
    }
    // public function index()
    // {
    //     $user = Auth::user();
    //     $countProjectsOwned = $user->projects()->count();
    // }
}
