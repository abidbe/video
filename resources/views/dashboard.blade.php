<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($videos as $video)
                            <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden flex flex-col">
                                <div class="relative pb-56">
                                    @if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail))
                                        <img class="absolute h-full w-full object-cover"
                                            src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}">
                                    @else
                                        <img class="absolute h-full w-full object-cover"
                                            src="https://via.placeholder.com/320x180?text=No+Image" alt="No Image">
                                    @endif
                                    <div
                                        class="absolute top-2 right-2 bg-gray-800 text-white text-xs px-2 py-1 rounded">
                                        {{ $video->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="flex-grow p-4 flex flex-col justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $video->title }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                        {{ $video->category ? $video->category->name : 'N/A' }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <a href="{{ route('videos.show', $video->id) }}"
                                            class="text-blue-600 dark:text-blue-400">View</a>
                                        <span
                                            class="text-sm text-gray-600 dark:text-gray-400">{{ $video->created_at->setTimezone('Asia/Jakarta')->format('g:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-6">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
