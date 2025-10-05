<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Enums\PermissionEnum;   

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clients = Client::paginate(20);
        return view('clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        try {
            Client::create($request->validated());
            return redirect()->route('clients.index')->with('success', 'Client created successfully.')->with('fade', 4500);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create client. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): RedirectResponse
    {
        return redirect()->route('clients.index')->with('success', 'Client shown successfully.')->with('fade', 4500);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): View
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.')->with('fade', 4500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        Gate::authorize(PermissionEnum::DELETE_CLIENTS->value);

        try {
            $client->delete();
            return redirect()->route('clients.index')->with('success', 'Client deleted successfully.')->with('fade', 4500);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to delete client. Please try again.']);
        }
    }
}
