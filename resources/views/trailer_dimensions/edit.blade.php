<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Trailer Dimension') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">Edit Trailer Dimension #{{ $trailerDimension->id }}</h3>
                    
                    <form action="{{ route('trailer_dimensions.update', $trailerDimension->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="length" class="block text-sm font-medium text-gray-700">Length (m)</label>
                            <input type="number" id="length" name="length" value="{{ old('length', $trailerDimension->length) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="width" class="block text-sm font-medium text-gray-700">Width (m)</label>
                            <input type="number" id="width" name="width" value="{{ old('width', $trailerDimension->width) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="height" class="block text-sm font-medium text-gray-700">Height (m)</label>
                            <input type="number" id="height" name="height" value="{{ old('height', $trailerDimension->height) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="max_load_capacity" class="block text-sm font-medium text-gray-700">Max Load Capacity (kg)</label>
                            <input type="number" id="max_load_capacity" name="max_load_capacity" value="{{ old('max_load_capacity', $trailerDimension->max_load_capacity) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="daily_rate" class="block text-sm font-medium text-gray-700">Daily Rate ($)</label>
                            <input type="number" id="daily_rate" name="daily_rate" value="{{ old('daily_rate', $trailerDimension->daily_rate) }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="daily_rate_description" class="block text-sm font-medium text-gray-700">Daily Rate Description</label>
                            <textarea id="daily_rate_description" name="daily_rate_description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>{{ old('daily_rate_description', $trailerDimension->daily_rate_description) }}</textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>