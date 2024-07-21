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
                    @if (session('status'))
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                            class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($videos as $video)
                            <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden flex flex-col">
                                <div class="relative pb-56">
                                    @if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail))
                                        <img class="absolute h-full w-full object-cover"
                                            src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}">
                                    @elseif($video->thumbnail && file_exists(public_path($video->thumbnail)))
                                        <img class="absolute h-full w-full object-cover"
                                            src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}">
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
                                        @php
                                            $existingRequest = $video
                                                ->requests()
                                                ->where('user_id', Auth::id())
                                                ->first();
                                        @endphp
                                        @if ($existingRequest && $existingRequest->approved_at && $existingRequest->expires_at > now())
                                            <span class="text-green-600 dark:text-green-400">Access Granted</span>
                                            <a href="{{ route('dashboard.show', $video->id) }}"
                                                class="text-blue-600 dark:text-blue-400">Watch Now</a>
                                        @elseif ($existingRequest && !$existingRequest->approved_at)
                                            <span class="text-yellow-600 dark:text-yellow-400">Pending Approval</span>
                                        @else
                                            <form action="{{ route('videos.request', $video) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-600 dark:text-blue-400">Request
                                                    Access</button>
                                            </form>
                                        @endif
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
