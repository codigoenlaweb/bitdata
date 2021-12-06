<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Public profile') }}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center">
                <div class="p-6 bg-white mb-6 text-xl border-b text-gray-600 border-solid border-b-2 border-gray-300">
                    Add information about yourself
                </div>

                <form method="POST" action="{{ route('profile.update', ['profile' => Auth::user()->id]) }}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @csrf

                    <p class="text-lg text-purple-800 font-bold">Basic information:</p>
                    <!-- Name -->
                    <div class="mt-2">
                        <img class="mx-auto w-44 h-44 rounded-full mb-4" src="{{ Storage::url(Auth::user()->profile) }}" alt="imageprofile">
                        <input type="file" name="profile" id="profile">
                        <p class="mb-6 text-gray-400 text-sm">Do you want to change your profile picture?</p>
                    </div>

                    <div class="mt-2">
                        <x-input id="name" class="block mt-1 w-5/6 md:w-1/2 mx-auto" type="text" name="name" placeholder="Name" :value="Auth::user()->name" required autofocus />
                    </div>

                    <!-- User -->
                    <div class="mt-6">
                        <x-input id="user" class="block mt-1 w-5/6 md:w-1/2 mx-auto" type="text" name="user" placeholder="User" :value="Auth::user()->user" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-6">
                        <x-input id="email" class="block mt-1 w-5/6 md:w-1/2 mx-auto" type="email" name="email" placeholder="Email" :value="Auth::user()->email" required />
                    </div>


                    <!-- facebook -->
                    <div class="flex mt-6 block mt-1 w-5/6 md:w-1/2 mx-auto">
                        <p class="leading-9 block mt-1 h-10 w-3/5 border shadow-sm border-gray-300">http://www.facebook.com/</p>
                        <input type="text" class="h-10 block border mt-1 w-full mx-auto shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="facebook" id="facebook" value="{{Auth::user()->facebook}}" placeholder="Facebook profile">
                    </div>
                    <p class="mb-6 text-gray-400 text-sm">Add your Facebook username (ex josemarti).</p>

                    <!-- instagram -->
                    <div class="flex mt-6 block mt-1 w-5/6 md:w-1/2 mx-auto">
                        <p class="leading-9 block mt-1 h-10 w-3/5 border shadow-sm border-gray-300">http://www.instagram.com/</p>
                        <input type="text" class="h-10 block border mt-1 w-full mx-auto shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="instagram" id="instagram" value="{{Auth::user()->instagram}}" placeholder="Instagram profile">
                    </div>
                    <p class="mb-6 text-gray-400 text-sm">Add your instagram username (ex josemarti).</p>

                    <!-- twiter -->
                    <div class="flex mt-6 block mt-1 w-5/6 md:w-1/2 mx-auto">
                        <p class="leading-9 block mt-1 h-10 w-3/5 border shadow-sm border-gray-300">http://twitter.com/</p>
                        <input type="text" class="h-10 block border mt-1 w-full mx-auto shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="twiter" id="twiter" value="{{Auth::user()->twiter}}" placeholder="Twiter profile">
                    </div>
                    <p class="mb-6 text-gray-400 text-sm">Add your Twitter username (ex josemarti).</p>

                    <!-- github -->
                    <div class="flex mt-6 block mt-1 w-5/6 md:w-1/2 mx-auto">
                        <p class="leading-9 block mt-1 h-10 w-3/5 border shadow-sm border-gray-300">https://github.com/</p>
                        <input type="text" class="h-10 block border mt-1 w-full mx-auto shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="github" id="github" value="{{Auth::user()->github}}" placeholder="Github profile">
                    </div>
                    <p class="mb-6 text-gray-400 text-sm">Add your github username (ex josemarti).</p>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="flex items-center justify-center mt-5 mb-6">
                        <x-button class="ml-4">
                            Save
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
