<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Insurer Values List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('insurer_values.create') }}" class="btn btn-primary mb-4">Add Insurer Value</a>

                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b text-left">ID</th>
                                <th class="px-4 py-2 border-b text-left">Insurer</th>
                                <th class="px-4 py-2 border-b text-left">Age Range</th>
                                <th class="px-4 py-2 border-b text-left">State Value</th>
                                <th class="px-4 py-2 border-b text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insurerValues as $insurerValue)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $insurerValue->id }}</td>
                                    <td class="px-4 py-2 border-b">{{ $insurerValue->insurer->name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $insurerValue->age_range }}</td>
                                    <td class="px-4 py-2 border-b">{{ $insurerValue->state_value }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <a href="{{ route('insurer_values.show', $insurerValue->id) }}" class="text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('insurer_values.edit', $insurerValue->id) }}" class="text-yellow-600 hover:underline ml-2">Edit</a>
                                        <form action="{{ route('insurer_values.destroy', $insurerValue->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this insurer value?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $insurerValues->links() }} <!-- Pagination Links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>