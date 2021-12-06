<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your control center!
        </h2>
    </x-slot>

    <div class="py-8">
        @if(Session::has('message'))
            <div class="mx-auto mb-3 w-4/6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Attention!</strong>
                <span class="block sm:inline">{{ Session::get('message') }}</span>
            </div>
        @endif
        <div class="flex flex-col md:flex-row">
            <div class="md:w-4/6 w-11/12 mx-auto">
                <div class="mx-auto px-2 w-full">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="text-center p-6 bg-white border-b border-gray-200 font-bold text-xl text-gray-800">
                            Your posts made!
                        </div>
                    </div>
                </div>


                <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @foreach ($posts as $post)
                            <div class="w-full bg-white rounded-lg sahdow-lg overflow-hidden flex flex-col md:flex-row">
                                <div class="w-full md:w-2/5 h-80">
                                   <a href="{{ route('posts.show', ['post' => $post->id])}}"><img class="object-center object-cover w-full h-full" src="{{ Storage::url($post['image']) }}" alt="photo"></a>
                                </div>
                                <div class="w-full md:w-3/5 text-left p-4 md:p-4 space-y-2">
                                    <p class="text-xl text-gray-600 font-bold hover:text-gray-800"><a href="{{ route('posts.show', ['post' => $post->id])}}">{{ $post->title }}</a></p>
                                    <p class="text-base leading-relaxed text-gray-500 font-normal"><a href="{{ route('posts.show', ['post' => $post->id])}}">{{ Str::limit($post->content, 200, '...') }}</a></p>
                                    <div class="flex justify-start space-x-2">
                                        <div class="flex mx-auto mt-2">
                                            <a href="{{ route('posts.edit', ['post' => $post->id])}}">
                                                <button class="mx-6 bg-white hover:bg-blue-500 hover:text-white text-gray-800 font-bold hover:border-blue-800 py-2 px-4 border border-gray-400 rounded shadow">
                                                    Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <input type="submit" onclick="return confirm('drop?')" value="Drop" class="mx-6 bg-white hover:bg-red-500 hover:text-white text-gray-800 font-bold hover:border-red-800 py-2 px-4 border border-gray-400 rounded shadow">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (!$posts->count())
                        <div class="text-center bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
                            <div class="py-6 bg-white border-b border-gray-200">
                                You haven't written any post yet :(
                            </div>
                        </div>
                    @endif
                </section>
            </div>



            <div class="md:w-2/6 w-11/12 px-2 mx-auto">
                <div class="mx-auto px-2 mt-4 md:mt-0 w-full mb-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-6 bg-white border-b border-gray-200 font-bold text-center text-xl text-gray-800">
                            Comments to your posts
                        </div>
                    </div>
                </div>


                @forelse ($coments as $coment)
                    @if (!$coment->status)
                        <div class="py-2 w-full mx-auto sm:px-5">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4">
                                <div class="bg-white border-gray-200">
                                    <div class="flex items-center">
                                        <img src="{{ Storage::url($coment->profile) }}" alt="profile" class="h-12 w-12">
                                        <p class="ml-2 text-2xl text-gray-600 font-bold rounded-full">{{ $coment->name }}</p>
                                        @if ($coment->user_id === Auth::user()->id || $posts->name === Auth::user()->name)
                                            <form method="POST" action="{{ route('coments.destroy', ['coment' => $coment->id]) }}">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{$coment->posts_id}}">
                                                <input type="submit" value="Drop" class="mx-6 bg-white hover:text-red-600 text-gray-800 font-bold hover:border-red-600 py-1 px-3 border border-gray-400 rounded shadow">
                                            </form>
                                        @endif
                                    </div>
                                    <p class="mt-1 text-lg text-gray-500 font-bold">{{ $coment->coment }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="py-2 w-full mx-auto sm:px-5">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 py-4">
                            <div class="bg-white border-gray-200">
                                <p class="mt-1 text-lg text-gray-500 font-bold">
                                    You have not received any comments
                                </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>

    </div>
</x-app-layout>
