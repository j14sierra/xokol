<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\View\View;
use App\Models\Service;
use App\Models\Project;
class ProjectController extends Controller
{
    public function index(Project $project) : View
    {

        $services = Service::where('is_active', true)
            ->whereHas('projects', function ($query) {
                $query->where('projects.is_active', true);
            })
            ->orderBy('sort_order')
            ->get();

        //Traer proyesctos relacionados, distintos al proyecto actual, que esten activos y que compartan al menos un servicio con el proyecto actual
        $relatedProjects = Project::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->whereHas('services', function ($query) use ($project) {
                $query->whereIn('services.id', $project->services->pluck('id'));
            })
            ->orderBy('sort_order')
            ->take(3)
            ->get();
        return view('project', compact('services', 'project', 'relatedProjects'));
    }
}
