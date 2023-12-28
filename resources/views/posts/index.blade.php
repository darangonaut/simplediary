<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                @auth
                <form method="POST" action="{{ route('posts.store') }}" class="max-w-lg mx-auto p-4 shadow-md rounded-lg" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <textarea 
                            name="body" 
                            id="body" 
                            cols="30" 
                            rows="3"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Your message here..."></textarea>
                    </div>
                    <button 
                        type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                        Post
                    </button>
                </form>
                @endauth
            </div>
            
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 mb-4 dark:text-gray-200
            flex flex-row justify-between
            ">
                {{ $post->body }}

                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                onsubmit="return confirm('Are you sure?');"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-gray-200">
            {{ $posts->links() }}
        </div>

    </div>
</x-app-layout>