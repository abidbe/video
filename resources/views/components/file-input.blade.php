@props(['id', 'name', 'class' => ''])

<input type="file" id="{{ $id }}" name="{{ $name }}"
    {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-900 border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }}>
