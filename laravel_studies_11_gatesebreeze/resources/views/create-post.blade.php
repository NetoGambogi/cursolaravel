<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            NEW POST
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10 bg-white rounded-sm shadow-sm p-10">

        <form action="{{ route('post.store') }}" method="post">
            
            @csrf

            <div class="mb-3">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                <input type="text" name="title" id="title" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content of the post</label>
                <textarea name="content" id="content" rows="5" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                @error('content')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 flex justify-between">
                <a href="{{ route('dashboard') }}" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-6 rounded">Cancel</a>
                <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-6 rounded">Create Post</button>
            </div>

        </form>

    </div>

</x-app-layout>