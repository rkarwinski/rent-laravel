<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Trailer Dimension Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold">Trailer Dimension #{{ $trailerDimension->id }}</h3>
                    <p><strong>Length:</strong> {{ $trailerDimension->length }} m</p>
                    <p><strong>Width:</strong> {{ $trailerDimension->width }} m</p>
                    <p><strong>Height:</strong> {{ $trailerDimension->height }} m</p>
                    <p><strong>Max Load Capacity:</strong> {{ $trailerDimension->max_load_capacity }} kg</p>
                    <p><strong>Daily Rate:</strong> ${{ number_format($trailerDimension->daily_rate, 2) }}</p>
                    <p><strong>Daily Rate Description:</strong> {{ $trailerDimension->daily_rate_description }}</p>
                    <p><strong>Created At:</strong> {{ $trailerDimension->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Updated At:</strong> {{ $trailerDimension->updated_at ? $trailerDimension->updated_at->format('d/m/Y H:i') : 'Not updated yet' }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>