<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Client') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Whoops! Something went wrong.</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="conatct_information font-large font-semibold text-xl text-gray-800 leading-tight mb-4">CONTACT INFORMATION</div>
                        <div class="mb-4">
                            <label for="contact_name" class="block text-sm font-medium text-gray-700">Contact Name</label>
                            <input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name') }}" class="mt-1 p-2 block w-full border @error('contact_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('contact_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                            <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" class="mt-1 p-2 block w-full border @error('contact_email') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('contact_email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="contact_phone_number" class="block text-sm font-medium text-gray-700">Contact Phone Number</label>
                            <input type="text" name="contact_phone_number" id="contact_phone_number" value="{{ old('contact_phone_number') }}" class="mt-1 p-2 block w-full border @error('contact_phone_number') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('contact_phone_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="company_information font-large font-semibold text-xl text-gray-800 leading-tight mb-4 mt-6">COMPANY INFORMATION</div>
                        <div class="mb-4">
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" class="mt-1 p-2 block w-full border @error('company_name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="company_address" class="block text-sm font-medium text-gray-700">Company Address</label>
                            <input type="text" name="company_address" id="company_address" value="{{ old('company_address') }}" class="mt-1 p-2 block w-full border @error('company_address') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('company_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="company_city" class="block text-sm font-medium text-gray-700">Company City</label>
                            <input type="text" name="company_city" id="company_city" value="{{ old('company_city') }}" class="mt-1 p-2 block w-full border @error('company_city') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('company_city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="company_zip" class="block text-sm font-medium text-gray-700">Company Zip</label>
                            <input type="text" name="company_zip" id="company_zip" value="{{ old('company_zip') }}" class="mt-1 p-2 block w-full border @error('company_zip') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            @error('company_zip')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="company_gst" class="block text-sm font-medium text-gray-700">Company GST</label>
                            <input type="text" name="company_gst" id="company_gst" value="{{ old('company_gst') }}" class="mt-1 p-2 block w-full border @error('company_gst') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @error('company_gst')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4 flex gap-2">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create Client</button>
                            <a href="{{ route('clients.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancel</a>
                        </div>
                        <div class="back">
                            <a href="{{ route('clients.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">Back to Clients</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>     
