@php
    $isEdit = isset($project);
    // TODO: Definir $selectedServices
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="title" class="block text-sm font-medium mb-1">Titulo <span class="text-red-500">*</span></label>
        <input id="title" name="title" type="text" value="{{ old('title', $project->title ?? '') }}"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium mb-1">Contenido <span class="text-red-500">*</span></label>
        <textarea id="description" name="description" rows="5"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image_carousel" class="block text-sm font-medium mb-1">Imagen Carousel <span class="text-red-500">*</span></label>
        <input id="image_carousel" name="image_carousel" type="file" accept="image/*"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2">
        @error('image_carousel')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        {{-- //TODO: mostrar imagen (si es formulario de editar) --}}
       
    </div>

    <div>
        <label for="image_grid" class="block text-sm font-medium mb-1">Imagen Grid <span class="text-red-500">*</span></label>
        <input id="image_grid" name="image_grid" type="file" accept="image/*"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2">
        @error('image_grid')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        {{-- //TODO: mostrar imagen (si es formulario de editar) --}}
       
    </div>

    <div>
        <label for="grid_image_size" class="block text-sm font-medium mb-1">Tamano Grid</label>
        <select id="grid_image_size" name="grid_image_size"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
            <option value="1" @selected(old('grid_image_size', $project->grid_image_size ?? '1') === '1')>1</option>
            <option value="2" @selected(old('grid_image_size', $project->grid_image_size ?? '1') === '2')>2</option>
            <option value="3" @selected(old('grid_image_size', $project->grid_image_size ?? '1') === '3')>3</option>
        </select>
        @error('grid_image_size')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="is_active" class="block text-sm font-medium mb-1">Estado</label>
        <select id="is_active" name="is_active"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
            <option value="1" @selected(old('is_active', (int) ($project->is_active ?? 1)) === 1)>Activo</option>
            <option value="0" @selected(old('is_active', (int) ($project->is_active ?? 1)) === 0)>Inactivo</option>
        </select>
    </div>
    
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-2">Servicios Asociados</label>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
            @forelse ($services as $service)
                @if ($service->is_active == true) 
                <label class="flex items-center gap-2 p-2 rounded-md border border-gray-300 dark:border-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input type="checkbox" id="service_{{ $service->id }}" name="service_ids[]"
                        value="{{ $service->id }}"
                        @checked(in_array($service->id, old('service_ids', $selectedServices ?? [])))>
                    <span class="text-sm">{{ $service->name }}</span>
                </label>
                @endif
            @empty
                <p class="text-gray-500 text-sm">No hay servicios disponibles.</p>
            @endforelse
        </div>
        @error('service_ids')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        @error('service_ids.*')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit"
        class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium">{{ $isEdit ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('admin.projects.index') }}"
        class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700">Cancelar</a>
</div>