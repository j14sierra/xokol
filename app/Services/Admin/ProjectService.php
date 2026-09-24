<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Project;

Class ProjectService{

    public function update(UpdateProjectRequest $request, Project $project): void
    {
    //validar los datos en la actualizacoón con FormRequest
        $ProjectData = $request->validated();
        $servicesIds = $ProjectData['service_ids'] ?? [];

        $this->syncProjectContentBlocks($project, $ProjectData);
        // $project->services()->sync($servicesIds);

        unset(
            $ProjectData['service_ids'],
            $ProjectData['block_content_types'],
            $ProjectData['block_titles'],
            $ProjectData['block_contents'],
            $ProjectData['block_images']
            ); // Eliminar los campos que no son parte de la tabla projects
        
        
        //Storage de las imágenes

        if ($request->hasFile('image_carousel')) {
            if($project->image_carousel) {
                Storage::disk('public')->delete($project->image_carousel);
            }
            $ProjectData['image_carousel'] = $request->file('image_carousel')->store('projects/carousel', 'public');
        }

        if ($request->hasFile('image_grid')) {
            if($project->image_grid) {
                Storage::disk('public')->delete($project->image_grid);
            }
            $ProjectData['image_grid'] = $request->file('image_grid')->store('projects/grid', 'public');
        }

         //Actualizar el proyecto y sincronizar los servicios
        $project->update($ProjectData);
        // Sincronizar los servicios asociados al proyecto
        $project->services()->sync($servicesIds);
    }

    private function syncProjectContentBlocks(Project $project, array $data): void
    {
        Log::info('Project content payload', [
            'project_id' => $project->id,
            'block_content_types' => $data['block_content_types'] ?? [],
            'block_titles' => $data['block_titles'] ?? [],
            'block_contents' => $data['block_contents'] ?? [],
            'block_images' => $data['block_images'] ?? [],
        ]);
    }
    
}
