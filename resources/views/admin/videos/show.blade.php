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
                    <h1 class="mb-4">{{ $video->title }}</h1>
                    <p class="mb-4"><strong>Category:</strong> {{ $video->category ? $video->category->name : 'N/A' }}
                    </p>
                    <video width="640" height="480" controls>
                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="mt-4">
                        <x-cancel-button href="{{ route('videos.index') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
