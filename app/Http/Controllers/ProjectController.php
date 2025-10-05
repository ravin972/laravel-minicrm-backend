<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Gate;
use App\Enums\PermissionEnum;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $projects = Project::with(['user', 'client'])->paginate(15);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $users = User::select('id', 'full_name')->get();
        $clients = Client::select('id', 'company_name')->get();
        return view('projects.create', compact('users', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        Project::create($request->validated());
        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        $users = User::select('id', 'full_name')->get();
        $clients = Client::select('id', 'company_name')->get();
        return view('projects.edit', compact('project', 'users', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($request->validated());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {   
        Gate::authorize(PermissionEnum::DELETE_PROJECTS->value);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');    
    }
}
