<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Trailer Dimension') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('trailer_dimensions.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="length" class="block text-gray-700">Length</label>
                            <input type="number" id="length" name="length" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="width" class="block text-gray-700">Width</label>
                            <input type="number" id="width" name="width" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="height" class="block text-gray-700">Height</label>
                            <input type="number" id="height" name="height" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="max_load_capacity" class="block text-gray-700">Max Load Capacity</label>
                            <input type="number" id="max_load_capacity" name="max_load_capacity" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="daily_rate" class="block text-gray-700">Daily Rate</label>
                            <input type="number" id="daily_rate" name="daily_rate" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="daily_rate_description" class="block text-gray-700">Daily Rate Description</label>
                            <textarea id="daily_rate_description" name="daily_rate_description" class="mt-1 block w-full"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>