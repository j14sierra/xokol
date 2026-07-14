<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;


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
    public function store(Request $request): RedirectResponse
    {


        //validación de los datos del formulario
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image_carousel' => 'required|image|max:5120',
            'image_grid' => 'required|image|max:5120',
            'grid_image_size' => 'integer',
            'is_active' => 'boolean',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'integer|exists:services,id',

        ]);

        //Storage de las imágenes
    
            $validatedData['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
            $validatedData['image_grid'] = $request->file('image_grid')->store('projects/grid', 'public');
      
         $project = Project::create($validatedData);
         $project->services()->sync($validatedData['service_ids']);
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
    public function update(Request $request, Project $project) : RedirectResponse
    {

        //validare los datos del formulario
         $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image_carousel' => 'nullable|image|max:5120',
            'image_grid' => 'nullable|image|max:5120',
            'grid_image_size' => 'integer',
            'is_active' => 'boolean',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'integer|exists:services,id',

        ]);

        //Storage de las imágenes
        if ($request->hasFile('image_carousel')) {
            if($project->image_carousel) {
                Storage::disk('public')->delete($project->image_carousel);
            }
            $validatedData['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
        }
        if ($request->hasFile('image_grid')) {
            if($project->image_grid) {
                Storage::disk('public')->delete($project->image_grid);
            }
            $validatedData['image_grid'] = $request->file('image_grid')->store('projects/grid', 'public');
        }
        

        $project->update($validatedData);
        $project->services()->sync($validatedData['service_ids'] ?? []);
        return redirect()->route('admin.projects.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
