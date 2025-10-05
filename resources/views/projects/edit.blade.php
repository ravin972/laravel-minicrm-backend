<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $project->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $project->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Deadline -->
                        <div class="mt-4">
                            <x-input-label for="deadline" :value="__('Deadline')" />
                            <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" :value="old('deadline', optional($project->deadline)->format('Y-m-d'))" />
                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                        </div>

                        <!-- Assigned User -->
                        <div class="mt-4">
                            <x-input-label for="user_id" :value="__('Assigned User')" />
                            <select name="user_id" id="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if(old('user_id', $project->user_id) == $user->id) selected @endif>{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                             <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Client -->
                        <div class="mt-4">
                            <x-input-label for="client_id" :value="__('Client')" />
                            <select name="client_id" id="client_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" @if(old('client_id', $project->client_id) == $client->id) selected @endif>{{ $client->company_name }}</option>
                                @endforeach
                            </select>
                             <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>
                        
                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach (['pending','in_progress','completed','cancelled'] as $status)
                                    <option value="{{ $status }}" @if(old('status', $project->status) == $status) selected @endif>{{ ucfirst(str_replace('_',' ',$status)) }}</option>
                                @endforeach
                            </select>
                             <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Project') }}
                            </x-primary-button>
                            <div class="back">
                                <a href="{{ route('projects.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">Back to Projects</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
