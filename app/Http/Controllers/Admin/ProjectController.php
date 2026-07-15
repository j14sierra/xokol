<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $services = Service::all();
        return view('admin.projects.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        //validación de datos con request
        $Data = $request->validated();
        //Storage de las imágenes
    
            $Data['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
            $Data['image_grid'] = $request->file('image_grid')->store('projects/grid', 'public');
      
         $project = Project::create($Data);
         $project->services()->sync($Data['service_ids']);
         return redirect()->route('admin.projects.index')->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
     $services = Service::all();
     $project->load('services');
        return view('admin.projects.edit', [
            'services' => $services,
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project) : RedirectResponse
    {
        //validar los datos en la actualizacoón con FormRequest
         $data = $request->validated();

        //Storage de las imágenes
        if ($request->hasFile('image_carousel')) {
            if($project->image_carousel) {
                Storage::disk('public')->delete($project->image_carousel);
            }
            $data['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
        }
        if ($request->hasFile('image_grid')) {
            if($project->image_grid) {
                Storage::disk('public')->delete($project->image_grid);
            }
            $data['image_grid'] = $request->file('image_grid')->store('projects/grid', 'public');
        }
        

        $project->update($data);
        $project->services()->sync($data['service_ids'] ?? []);
        return redirect()->route('admin.projects.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
       if($project->image_carousel) {
                Storage::disk('public')->delete($project->image_carousel);
            }

         if($project->image_grid) {
                Storage::disk('public')->delete($project->image_grid);
            }

        //desvincular los servicios
        $project->services()->detach();
        //eliminar el proyecto
        $project->delete($project);
        return redirect()->back()->with('success', 'Proyecto eliminado exitosamente.');
    }
}
