<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tasks = Task::with('user', 'client', 'project')->paginate(20);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View  
    {
        $users = User::select(['id', 'full_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();
        $projects = Project::select(['id', 'title'])->get();

        return view('tasks.create', compact('users', 'clients', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        $users = User::select(['id', 'full_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();
        $projects = Project::select(['id', 'title'])->get();

        return view('tasks.edit', compact('task', 'users', 'clients', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {   
        Gate::authorize(PermissionEnum::DELETE_TASKS->value);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
