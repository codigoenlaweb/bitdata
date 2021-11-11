
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create an awesome post
        </h2>
    </x-slot>
    <div class="mt-4 flex items-center justify-center">

        <form method="POST" action="{{ route('posts.store') }}" class="p-4 w-11/12 ms:w-4/5 mt-4 bg-white rounded-lg" enctype="multipart/form-data">
            @csrf

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Title -->
            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$posts->title" required autofocus />
            </div>

            <!-- content -->
            <div class="mt-4">
                <x-label for="content" :value="__('Content')" />

                <textarea id="content" class="h-28 focus:border-blue-100 block mt-1 w-full rounded-md border-gray-300" name="content" required>{{$posts->content}}</textarea>
            </div>

            <!-- Post Image -->
            <div class="mt-4">
                <x-label for="image" :value="__('change image')"/>
                <x-input id="image" class="mt-2" type="file" name="image"/>
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-button class="mx-4">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
