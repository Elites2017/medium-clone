<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <ul class="flex flex-wrap text font-medium text-center text-gray-500 dark:text-gray-400 justify-center">

                    <li class="me-2">
                        <a href="#" class="inline-block px-4 py-3 text-blue bg-blue-600 rounded-lg active"
                            aria-current="page">All</a>
                    </li>

                    @foreach ($categories as $category)
                        <li class="me-2">
                            <a href="#"
                                class="inline-block px-4 py-3 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach

                </ul>

            </div>

            </br>
            {{-- for the posts --}}

            <div class="mt-8 text-gray-900">

                
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