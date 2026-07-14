<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Displays the project listing.
     *
     * @return View The project listing view populated with all projects.
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
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Displays the specified project resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Defines the edit action for a project resource.
     *
     * @param string $id The identifier of the project to edit.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Updates a project resource.
     *
     * @param Request $request The request containing the updated project data.
     * @param string $id The project identifier.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
