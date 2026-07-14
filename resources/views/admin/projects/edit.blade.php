<x-layouts.app>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Editar Proyecto</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Actualiza la información del proyecto.</p>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.projects._form',[
                'services' => $services,
                'project' => $project,
                'isEdit' => true
            ])
        </form>
    </div>  
</x-layouts.app>