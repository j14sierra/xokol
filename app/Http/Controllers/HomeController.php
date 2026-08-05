<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;


class HomeController extends Controller
{
    public function index(Request $request)
    {

        $selectedService = $request['service'];
        // Obtenga los servicios que estén activos y tengan al menos un proyecto activo.
        $services = Service::where('is_active', true)
            ->whereHas('projects', function ($query) {
                $query->where('projects.is_active', true);
            })
            ->orderBy('sort_order')
            ->get();

        $projectQuery = Project::where('is_active', true);

        if ($selectedService) {
            $projectQuery->whereHas('services', function ($query) use ($selectedService) {
                $query->where('services.id', $selectedService);
            });
        }
        $projects = $projectQuery->take(12)->get();

        return view('home', compact('services', 'projects', 'selectedService'));
    }
}
