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
        $projectCount = Project::where('user_id', Auth::id())->count();
        $projects = Project::where('user_id', Auth::id())
        ->orWhereHas('users', function ($query) {
            $query->where('users.id', Auth::id());
        })->orderBy('project_end_date', 'desc')->limit(4)->get();
        
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
        $tasks = Task::orderBy('task_end_date')->limit(10)->get();

        return view('dashboard.mainmenu', compact('projects', 'tasks', 'projectCount', 'projectComplete', 'taskComplete'));
    }
    // public function index()
    // {
    //     $user = Auth::user();
    //     $countProjectsOwned = $user->projects()->count();
    // }
}
