{{-- the props which will be passed to this component --}}
@props(['user', 'size' => 'w-20 h-20'])

@if ($user->image)
    <a href="{{ route('profile.show', [$user]) }}">
        <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="rounded-full {{ $size }}" />
    </a>
@else
    <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png" class="rounded-full {{ $size }}" />
@endif