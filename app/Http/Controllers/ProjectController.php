<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use illuminate\View\View;
use App\Models\Service;
use App\Models\Project;


class ProjectController extends Controller
{
    public function index(Request $request, Project $project): View
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

            $this->incrementViewCount($request, $project->id);

            $sessionKey = "project_liked_{$project->id}";
            $alreadyLiked = $request->session()->get($sessionKey, false);
            
            [$titleMain, $titleAccent] = $this->splitTitle($project->title);

        return view('project', [
            'services'=> $services, 
            'project'=> $project, 
            'relatedProjects'=> $relatedProjects, 
            'alreadyLiked'=> $alreadyLiked, 
            'titleMain'=> $titleMain, 
            'titleAccent'=> $titleAccent,
        ]);
    }

    
        //funcion para incrementar el contador de likes del proyecto, solo si el usuario no ha dado like al proyecto en la misma sesión
        public function registerLike(Request $request, Project $project): RedirectResponse
        {
            $sessionKey = "project_liked_{$project->id}";
    
            if (!$request->session()->get($sessionKey)) {
                $project->increment('likes_count');
                $request->session()->put($sessionKey, true);
            }
            
            return  redirect()->route('project', $project);
        }

    //funcion para incrementar el contador de vistas del proyecto, solo si el usuario no ha visto el proyecto en la misma sesión
    private function incrementViewCount($request, $projectId): void
    {
        $sessionKey = "viewed_project_{$projectId}";
        if (!$request->session()->has($sessionKey)) {
            Project::whereKey($projectId)->increment('view_count');
            $request->session()->put($sessionKey, true);
        }
    }

    private function splitTitle($title): array
    {
            $parts = explode(' ', $title);
          
            if (count($parts) === 1 ) {
                $parts = [$parts[0], ''];
            }
            $accent =array_pop($parts);
            $mainTitle = implode(' ', $parts);

            return [$mainTitle, $accent];
    }
}
