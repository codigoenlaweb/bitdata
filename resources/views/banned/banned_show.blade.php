<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Banned
        </h2>
    </x-slot>

    <div class="py-8">
        @if(Session::has('message'))
            <div class="mx-auto mb-3 w-4/6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Attention!</strong>
                <span class="block sm:inline">{{ Session::get('message') }}</span>
            </div>
        @endif
        <img class="w-full md:w-9/12 lg:w-5/12 mx-auto rounded-lg" src="{{ Storage::url('public/bitdata/banned.jpg') }}" alt="photo">

        <p class="mt-4 w-full md:w-9/12 lg:w-5/12 mx-auto rounded-lg text-center bg-white p-4 shadow font-semibold text-xl text-gray-700 leading-tight">You have been banned</p>


        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    banned
                </div>
            </div>
        </div> --}}
    </div>
</x-app-layout>
