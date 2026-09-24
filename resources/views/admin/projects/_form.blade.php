@php
    $isEdit = isset($project);
    $selectedServices = old('service_ids', $isEdit ? $project->services->pluck('id')->all() : []);
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
        <input
            id="image_carousel"
            name="image_carousel"
            type="file"
            accept="image/*"
            data-preview="preview_carousel"
            onchange="previewImage(this, 'preview_carousel')"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2">

        <div class="mt-3">
            <p class="text-sm text-gray-500 mb-2">Vista previa:</p>
            <img
                id="preview_carousel"
                src="{{ $isEdit && $project->image_carousel ? Storage::url($project->image_carousel) : '' }}"
                class="w-56 h-40 object-cover rounded-lg border border-gray-300 dark:border-gray-700 {{ !$isEdit || !$project->image_carousel ? 'hidden' : '' }}">
        </div>
        @error('image_carousel')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
 
       
    </div>

    <div>
        <label for="image_grid" class="block text-sm font-medium mb-1">Imagen Grid <span class="text-red-500">*</span></label>
        <input
            id="image_grid"
            name="image_grid"
            type="file"
            accept="image/*"
            data-preview="preview_grid"
            onchange="previewImage(this, 'preview_grid')"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2">

        <div class="mt-3">
            <p class="text-sm text-gray-500 mb-2">Vista previa:</p>
            <img
                id="preview_grid"
                src="{{ $isEdit && $project->image_grid ? Storage::url($project->image_grid) : '' }}"
                class="w-56 h-40 object-cover rounded-lg border border-gray-300 dark:border-gray-700 {{ !$isEdit || !$project->image_grid ? 'hidden' : '' }}">
        </div>
        @error('image_grid')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
   
      

    </div>

    <div>
        <label for="grid_image_size" class="block text-sm font-medium mb-1">Tamano Grid</label>
        <select id="grid_image_size" name="grid_image_size"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
            <option value="1" @selected((string) old('grid_image_size', $project->grid_image_size ?? '1') === '1')>1</option>
            <option value="2" @selected((string) old('grid_image_size', $project->grid_image_size ?? '1') === '2')>2</option>
            <option value="3" @selected((string) old('grid_image_size', $project->grid_image_size ?? '1') === '3')>3</option>
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

    @if ($isEdit)
        <div class="my-8 border-t border-gray-200 dark:border-gray-700"></div>

        <div class="space-y-4" x-data="{showBlockType: false, selectedBlockType: ''}">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Bloques</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Agrega bloques adicionales dentro del mismo formulario.
                    </p>
                </div>

                <button
                    @click="showBlockType = true"
                    type="button"
                    class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-slate-300"
                >
                    Agregar bloque
                </button>
            </div>

            <div class="space-y-6">
                <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                    <div class="mb-4">
                        <h3 class="text-base font-medium text-gray-800 dark:text-gray-100">
                            Bloque 1
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div x-show="showBlockType">
                            <label class="mb-1 block text-sm font-medium" for="block_content_type_1">
                                Tipo de Contenido
                            </label>

                            <select
                                x-model="selectedBlockType"
                                id="block_content_type_1"
                                name="block_content_types[]"
                                class="w-full rounded-md border-gray-300 p-2 dark:border-gray-700 dark:bg-gray-900"
                            >
                                <option value="">Elige un tipo de contenido</option>
                                <option value="title">Título</option>
                                <option value="text">Texto</option>
                                <option value="image">Imagen</option>
                            </select>
                        </div>

                        <div x-show="selectedBlockType === 'title'">
                            <label class="mb-1 block text-sm font-medium" for="block_title_1">
                                Título
                            </label>

                            <input
                                id="block_title_1"
                                name="block_titles[]"
                                type="text"
                                class="w-full rounded-md border-gray-300 p-2 dark:border-gray-700 dark:bg-gray-900"
                            >
                        </div>

                        <div x-show="selectedBlockType === 'text'">
                            <label class="mb-1 block text-sm font-medium" for="block_content_1">
                                Texto enriquecido
                            </label>

                            <textarea
                                id="block_content_1"
                                name="block_contents[]"
                                rows="5"
                                data-rich-text="true"
                                class="w-full rounded-md border-gray-300 p-2 dark:border-gray-700 dark:bg-gray-900"
                            ></textarea>
                        </div>

                        <div x-show="selectedBlockType === 'image'">
                            <label class="mb-1 block text-sm font-medium" for="block_image_1">
                                Imagen
                            </label>

                            <input
                                id="block_image_1"
                                name="block_images[]"
                                type="file"
                                accept="image/*"
                                class="w-full rounded-md border-gray-300 p-2 dark:border-gray-700 dark:bg-gray-900"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

<div class="mt-6 flex gap-3">
    <button type="submit"
        class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium">{{ $isEdit ? 'Actualizar' : 'Crear' }}</button>
    <a href="{{ route('admin.projects.index') }}"
        class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700">Cancelar</a>
</div>

