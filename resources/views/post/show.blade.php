<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-2xl mb-4">{{ $post->title }}</h1>
                {{-- user avatar section --}}
                <div class="flex gap-4">
                    
                    {{-- the props defined in the following componenet --}}
                    <x-user-avatar-component :user="$post->user" />
                    
                    <div>
                        <x-follow-un-follow-container :user="$post->user" class="flex gap-4">
                            <a class="hover:underline" href="{{ route('profile.show', [$post->user]) }}">{{  $post->user->name }}</a>
                            @auth
                                &middot;
                                <button class="text-emerald-500" x-text=" following ? 'Unfollow' : 'Follow'" :class="following ? 'text-red-600' : 'text-emerald-600'" @click="follow()">
                                </button>
                            @endauth
                        </x-follow-un-follow-container>

                        <div class="flex gap-2 text-gray-500 text-small">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
                {{-- clap section --}}
                <x-clap-button :post="$post">
                    
                </x-clap-button>

                {{-- content section --}}
                <div>
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full"/>
                    
                    <div class="mt-4">
                        {{ $post->content }}
                    </div>

                </div>

                {{-- category section --}}
                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-400 rounded-xl font-bold">{{ $post->category->name }}</span>
                </div>

                {{-- clap section --}}
                <x-clap-button :post="$post">
                    
                </x-clap-button>

            </div>
        </div>
    </div>
</x-app-layout>