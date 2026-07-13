<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){
    
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', [
            'services' => $services,
        ]);
    }

    public function create(){
        return view('admin.services.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'is_active' => 'required|integer',
            'sort_order' => 'boolean',
        ]);

        Service::create($validatedData);

        return redirect()->back()->with('success', 'Servicio creado exitosamente.');
    }

    public function edit(Service $service){
        if (!$service) {
            return redirect()->back()->with('error', 'Servicio no encontrado.');
        }

        return view('admin.services.edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer',
        ]);

        $service->update($validatedData);

        return redirect()->back()->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Service $service){
        $service->delete($service);

        return redirect()->back()->with('success', 'Servicio eliminado exitosamente.');
    }

}
