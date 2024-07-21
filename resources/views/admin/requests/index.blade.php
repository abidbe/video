<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Video Requests') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Id</th>
                                <th scope="col" class="px-6 py-3">Customer</th>
                                <th scope="col" class="px-6 py-3">Video</th>
                                <th scope="col" class="px-6 py-3">Requested At</th>
                                <th scope="col" class="px-6 py-3">Approved At</th>
                                <th scope="col" class="px-6 py-3">Expires At</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($requests as $request)
                                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td class="px-6 py-4">{{ $request->id }}</td>
                                    <td class="px-6 py-4">{{ $request->user->name }}</td>
                                    <td class="px-6 py-4">{{ $request->video->title }}</td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($request->requested_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $request->approved_at? \Carbon\Carbon::parse($request->approved_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i'): 'Pending' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $request->expires_at? \Carbon\Carbon::parse($request->expires_at)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i'): 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">

                                        @if (!$request->approved_at)
                                            <form action="{{ route('video_requests.approve', $request) }}"
                                                method="POST">
                                                @csrf
                                                <div class="flex gap-3">
                                                    <input type="number" name="hours" placeholder="Hours" required
                                                        step="1"
                                                        class="w-20 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                                                    <button type="submit"
                                                        class="text-blue-600 dark:text-blue-400 flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 00-2 0v4a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L11 10.586V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Approve
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            <span class="text-green-600 dark:text-green-400 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707a1 1 0 00-1.414-1.414L9 11.586 7.707 10.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Approved
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td colspan="7" class="px-6 py-4 font-medium text-gray-900 dark:text-white">No
                                        Requests Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-6">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
