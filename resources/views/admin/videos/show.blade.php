<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('View Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-center items-center mb-10">
                        <h1 class="text-2xl font-bold">{{ $video->title }}</h1>
                        <div class="ml-4 bg-gray-100 dark:bg-gray-700 px-4 rounded-full shadow">
                            <p class="text-gray-600 dark:text-gray-400">
                                {{ $video->category ? $video->category->name : 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex justify-center mb-4">
                        @if ($video->path && file_exists(public_path($video->path)))
                            <video class="rounded-lg" width="640" height="480" controls>
                                <source src="{{ asset($video->path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif ($video->path && Storage::disk('public')->exists($video->path))
                            <video class="rounded-lg" width="640" height="480" controls>
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p class="text-red-600 dark:text-red-400">Video not available</p>
                        @endif
                    </div>
                    <div class="mt-4 flex justify-center">
                        <x-back-button href="{{ url()->previous() }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
