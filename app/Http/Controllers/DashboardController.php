<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Modul;
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
            ->limit(3)
            ->get();
        $projectComplete = Project::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereHas('users', function ($query) {
                    $query->where('users.id', Auth::id());
                });
        })
            ->where('project_status', 'selesai')
            ->count();
        $modulComplete = Modul::where('modul_status', 'selesai')
            ->orderBy('modul_end_date')
            ->with('proyek')
            ->count();
        $moduls = Modul::join('projects', 'moduls.project_id', '=', 'projects.id')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('handled_by_id', $user->id);
            })
            ->select('moduls.*', 'projects.project_name')
            ->orderBy('modul_end_date', 'desc')
            ->limit(10)
            ->count();
        $modules = Modul::join('projects', 'moduls.project_id', '=', 'projects.id')
            ->whereHas('users', function ($query) use ($user) {
                $query->where('handled_by_id', $user->id);
            })
            ->select('moduls.*', 'projects.project_name')
            ->orderBy('modul_end_date', 'desc')
            ->limit(5)
            ->get();


        return view('dashboard.mainmenu', compact('projects', 'moduls', 'modules', 'projectCount', 'projectComplete', 'modulComplete'));
    }
    // public function index()
    // {
    //     $user = Auth::user();
    //     $countProjectsOwned = $user->projects()->count();
    // }
}
