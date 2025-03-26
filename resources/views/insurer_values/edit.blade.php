<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Insurer Value') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('insurer_values.update', $insurerValue->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="insurer_id" class="block text-sm font-medium text-gray-700">Insurer</label>
                            <select id="insurer_id" name="insurer_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Select Insurer</option>
                                @foreach ($insurers as $insurer)
                                    <option value="{{ $insurer->id }}" {{ $insurer->id == $insurerValue->insurer_id ? 'selected' : '' }}>{{ $insurer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="age_range" class="block text-sm font-medium text-gray-700">Age Range</label>
                            <input type="text" id="age_range" name="age_range" value="{{ old('age_range', $insurerValue->age_range) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <label for="state_value" class="block text-sm font-medium text-gray-700">State Value</label>
                            <input type="number" id="state_value" name="state_value" value="{{ old('state_value', $insurerValue->state_value) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Update Insurer Value</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>