<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl mb-4">Edit Post: <strong class="font-bold">{{ $post->title }}</strong></h1>
            {{-- Display any validation errors --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('post.update', $post) }}" class="form-group" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')

                    <!-- Image -->
                    @if ($post->image)
                        <div class="mb-4">
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="rounded-full h-20 w-20">
                        </div>
                            
                    @endif

                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                            :value="old('image')" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title', $post->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Text Area -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-text-area-input id="content" class="block mt-1 w-full" name="content"
                            :content="$post->content" :value="old('content', $post->content)" required />
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Published At -->
                    <div class="mt-4">
                        <x-input-label for="published_at" :value="__('Published At')" />
                        <x-text-input id="published_at" class="block mt-1 w-full" type="datetime-local" name="published_at"
                            :value="old('published_at', $post->published_at)" required autofocus />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                    </div>

                    <div class="group mt-4">
                        <x-danger-button class="ms-3">
                            {{ __('Cancel') }}
                        </x-danger-button>
                        
                        <x-primary-button class="ms-3">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>

                </form>



            </div>
        </div>
    </div>
</x-app-layout>