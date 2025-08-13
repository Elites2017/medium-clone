<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    {{-- post related --}}
                    <div class="flex-2 pr-8">
                        <h1 class="text-5xl">{{ $user->name }}</h1>

                        <div class="mt-8">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post"></x-post-item>
                            @empty
                                <div class="text-center text-gray-400 py-16">No posts found</div>
                            @endforelse
                        </div>

                    </div>

                    
                    {{-- sidebar info --}}
                    <x-follow-un-follow-container :user="$user">
                        {{-- the props defined in the following componenet --}}
                        <x-user-avatar-component :user="$user" size="w-18 h-18" />
                        <h3>{{ $user->name }}</h3>
                        <p class="text-gray-500"><span x-text="followersCount > 1 ? followersCount + ' followers ' : followersCount + ' follower ' "></span><p>
                        <p class="text-gray-500">{{ $user->bio }}</p>
                        @if(auth()->user() && auth()->user()->id !== $user->id)
                            <div class="mt-2">
                                <button class="rounded-full px-4 py-2 text-white" x-text=" following ? 'Unfollow' : 'Follow'" :class="following ? 'bg-red-600' : 'bg-emerald-600'" @click="follow()">
                                    
                                </button>
                            </div>    
                        @endif
                    </x-follow-un-follow-container>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
