<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <x-category-tabs>
                    {{-- use it like this so that the slot can be used --}}
                    No categories found !
                </x-category-tabs>

            </div>

            {{-- for the posts --}}

            <div class="mt-6 text-gray-900">

                
                    @forelse ($posts as $post)
                        <x-post-item :post="$post" />
                    @empty
                        <div class="text-center font-bold">No posts found ! </div>
                    @endforelse
            </div>

            {{-- for the page links --}}
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>