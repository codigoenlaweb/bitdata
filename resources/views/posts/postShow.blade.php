<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create By {{ ($posts->name) }}
        </h2>
    </x-slot>

    <div class="py-8">
        @if(Session::has('message'))
            <div class="mx-auto mb-3 w-4/6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Attention!</strong>
                <span class="block sm:inline">{{ Session::get('message') }}</span>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-3xl text-gray-600 font-bold">{{ $posts->title }}</h2>
                    <p class="text-lg text-gray-500 font-bold">{{ $posts->likes }} likes</p>
                    <p class="text-base text-gray-400 font-bold">Post date: {{ $posts->created_at->format('d-m-Y') }}</p>
                    <div>
                        <p>{{ $posts->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if ($posts->name === Auth::user()->name)
            <div class="mt-3 flex justify-center">
                <a href="{{ route('posts.edit', ['post' => $posts->id])}}">
                    <button class="mx-6 bg-white hover:bg-blue-500 hover:text-white text-gray-800 font-bold hover:border-gray-500 py-2 px-4 border border-gray-400 rounded shadow">
                        Edit
                    </button>
                </a>

                <button class="mx-6 bg-white hover:bg-red-500 hover:text-white text-gray-800 font-bold hover:border-gray-500 py-2 px-4 border border-gray-400 rounded shadow">
                    Drop
                </button>
            </div>
        @endif
    </div>
</x-app-layout>
