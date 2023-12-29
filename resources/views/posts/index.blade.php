<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full flex-col md:flex-row md:justify-between
            ">
        <div class="w-auto">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Posts') }}
            </h2>

            <h3 class="break-keep">
                Count of posts: {{ $count }}
            </h3>
        </div>

        <div class="w-full md:w-1/2 mt-4 md:mt-0">
            <form action="{{ route('posts.search') }}" method="GET" class="w-full mx-auto rounded-lg" enctype="multipart/form-data">
                <div class="flex">
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        class="flex-grow p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Search..."
                        value="{{ request()->query('search') }}"
                    >
                    <button 
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg"
                    >
                        Search
                    </button>
                </div>
            </form>
        </div>
        </div>
    
    </x-slot>

    <div class="py-12">



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 p-4">
                @auth
                <form method="POST" action="{{ route('posts.store') }}" class="max-w-xl mx-auto p-4 shadow-md rounded-lg" enctype="multipart/form-data">
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
                    <div class="flex justify-center">
                        <button 
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Post
                        </button>
                    </div>
                </form>

                @endauth
            </div>
            
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-4">
            @foreach ($posts as $post)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 dark:text-gray-200 ">
                <div class="flex flex-row justify-between">
                    <span class="text-gray-400 mr-4">
                        {!! nl2br(e($post->body)) !!}
                    </span>

                    <div class="flex flex-row h-8">
                        <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                            </svg>                    
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="w-full text-gray-400 text-sm mr-4">
                    {{ $post->updated_at->format('Y-m-d') }}
                </div>

            </div>
            @endforeach
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-gray-200 mt-4">
            {{ $posts->links() }}
        </div>

    </div>
</x-app-layout>