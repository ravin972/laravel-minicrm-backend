@php use App\Enums\PermissionEnum; @endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display success message -->
                    @if (session('success'))
                        <div id="flash-success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative transition-opacity duration-700" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var el = document.getElementById('flash-success');
                                if (!el) return;
                                setTimeout(function () {
                                    el.style.opacity = '0';
                                    setTimeout(function () {
                                        if (el && el.parentNode) {
                                            el.parentNode.removeChild(el);
                                        }
                                    }, 800);
                                }, 4000);
                            });
                        </script>
                    @endif

                    <a href="{{ route('clients.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 mb-4">Create Client</a>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Company GST
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Address
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $client->contact_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $client->company_gst }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $client->company_address }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('clients.edit', $client) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        @can(PermissionEnum::DELETE_CLIENTS->value)
                                        |
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $clients->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
