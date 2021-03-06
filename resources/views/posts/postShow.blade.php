<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create By {{ ($posts->user) }}
        </h2>
    </x-slot>

    <div class="py-8">
        @if(Session::has('message'))
            <div class="mx-auto mb-3 w-4/6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Attention!</strong>
                <span class="block sm:inline">{{ Session::get('message') }}</span>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-11/12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-3xl text-gray-600 font-bold">{{ $posts->title }}</h2>
                    <!-- likes -->
                    <div class="flex">
                        <p class="text-lg text-gray-500 font-bold mr-4">{{ $countlikes }} likes</p>
                        <!-- form likes -->
                        @if ($post_like_count === 0)
                            <form action="{{ route('likes.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                <button class="text-white px-4 w-auto h-7 bg-gray-500 rounded-full hover:bg-gray-600 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
                                    <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-4 h-4 inline-block">
                                        <path fill="#FFFFFF" d="M17.19,4.155c-1.672-1.534-4.383-1.534-6.055,0L10,5.197L8.864,4.155c-1.672-1.534-4.382-1.534-6.054,0
                                            c-1.881,1.727-1.881,4.52,0,6.246L10,17l7.19-6.599C19.07,8.675,19.07,5.881,17.19,4.155z"/>
                                    </svg>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('likes.destroy', ['like' => $post_like[0]->id]) }}" method="post">
                                {{ method_field('DELETE') }}
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                <button class="text-white px-4 w-auto h-7 bg-purple-500 rounded-full hover:bg-purple-600 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
                                    <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-4 h-4 inline-block">
                                        <path fill="#FFFFFF" d="M17.19,4.155c-1.672-1.534-4.383-1.534-6.055,0L10,5.197L8.864,4.155c-1.672-1.534-4.382-1.534-6.054,0
                                            c-1.881,1.727-1.881,4.52,0,6.246L10,17l7.19-6.599C19.07,8.675,19.07,5.881,17.19,4.155z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif

                    </div>
                    <!-- end likes -->
                    <p class="text-base text-gray-400 font-bold my-1">Post date: {{ $posts->created_at->format('d-m-Y') }}</p>
                    <div>
                        <p>{{ $posts->content }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if ($posts->user_id === Auth::user()->id || Auth::user()->role === 'admin')
            <div class="mt-4 flex justify-center">
                @if ($posts->user_id === Auth::user()->id)
                    <a href="{{ route('posts.edit', ['post' => $posts->id])}}">
                        <button class="mx-6 bg-white hover:bg-blue-500 hover:text-white text-gray-800 font-bold hover:border-blue-800 py-2 px-4 border border-gray-400 rounded shadow">
                            Edit
                        </button>
                    </a>
                @endif

                @if (Auth::user()->role === 'admin' && !$posts->banned)
                    <form method="POST" action="{{ route('bannedpost.update', ['banned_post' => $posts->user_id]) }}">
                        {{ method_field('PUT') }}
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                        <input type="submit" onclick="return confirm('banned user?')" value="Banned" class="mx-6 bg-white hover:bg-red-500 hover:text-white text-gray-800 font-bold hover:border-red-800 py-2 px-4 border border-gray-400 rounded shadow">
                    </form>
                @endif

                <form method="POST" action="{{ route('posts.destroy', ['post' => $posts->id]) }}">
                    {{ method_field('DELETE') }}
                    @csrf
                    <input type="submit" onclick="return confirm('drop?')" value="Drop" class="mx-6 bg-white hover:bg-red-500 hover:text-white text-gray-800 font-bold hover:border-red-800 py-2 px-4 border border-gray-400 rounded shadow">
                </form>
            </div>
        @endif

        <div class="mt-14">
            <div class="w-11/12 md:w-4/5 lg:w-3/4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4">
                    <div class="bg-white border-gray-200 text-center">
                        <p class="text-2xl text-gray-600 font-bold">Comment on this post</p>
                    </div>
                    <form action="{{ route('coments.store') }}" method="post" class="mx-auto mt-4">
                        @csrf
                        <textarea class="w-full text-lg resize-none border rounded-md h-24 bg-transparent" name="coment" id="coment"></textarea>
                        <div class="flex justify-end">
                            <input type="submit" value="Send" name="send" id="send" class="px-4 py-2 bg-gray-800 text-white rounded">
                        </div>
                        <input type="hidden" name="post_id" id="post_id" value="{{$posts->id}}">
                    </form>
                </div>
            </div>
        </div>

        <div class="pt-10">
            <div class="w-11/12 md:w-4/5 lg:w-3/4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4">
                    <div class="bg-white border-gray-200">
                        <p class="text-2xl text-gray-600 font-bold">{{$countcoments}} coments</p>
                    </div>
                </div>
            </div>
        </div>
        @forelse ($coments as $coment)
            @if (!$coment->status)
                <div class="py-2">
                    <div class="w-11/12 md:w-4/5 lg:w-3/4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4">
                            <div class="bg-white border-gray-200">
                                <div class="flex items-center">
                                    <img src="{{ Storage::url($coment->profile) }}" alt="profile" class="h-12 w-12">
                                    <p class="ml-2 text-2xl text-gray-600 font-bold rounded-full">{{ $coment->name }}</p>
                                    @if ($coment->user_id === Auth::user()->id || Auth::user()->role === 'admin')
                                        <form method="POST" action="{{ route('coments.destroy', ['coment' => $coment->id]) }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{$coment->posts_id}}">
                                            <input type="submit" value="Drop" class="mx-6 bg-white hover:text-red-600 text-gray-800 font-bold hover:border-red-600 py-1 px-3 border border-gray-400 rounded shadow">
                                        </form>

                                        <form method="POST" action="{{ route('coments.update', ['coment' => $coment->id]) }}">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{$coment->posts_id}}">
                                            <input type="submit" value="Reported!" class="bg-white hover:text-red-600 text-gray-800 font-bold hover:border-red-600 py-1 px-3 border border-gray-400 rounded shadow">
                                        </form>
                                    @endif
                                </div>
                                <p class="mt-1 text-lg text-gray-500 font-bold">{{ $coment->coment }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty

        @endforelse
    </div>
</x-app-layout>


