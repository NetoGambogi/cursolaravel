<div class="mt-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="{{Auth::user()->id === $post->user_id ? "bg-blue-100" : "bg-white"}} overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex justify-between">
                    <div>
                        <span class="text-gray-500 me-3">Author:</span>
                        <span class="text-blue-600">{{ $post->user->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 me-3">Created at:</span>
                        <span>{{ $post->created_at }}</span>
                    </div>
                </div>

                <div class="mt-3 ps-5">
                    <h1 class="text-xl font-bold">{{ $post->title }}</h1>
                    <p class="mt-3">{{ $post->content }}</p>
                </div>

                <div class="mt-3 ps-5 text-end">
                    {{-- deletar posts --}}
                    @can('post.delete', $post)
                        <a href="{{route('post.delete', ['id' => $post->id])}}" class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-6 rounded">Delete</a>
                    @endcan

                </div>

            </div>
        </div>
    </div>
</div>
