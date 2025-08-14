@props(['user'])

<div {{ $attributes }} x-data="{

following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
followersCount: {{ $user->followers()->count() }},
follow() {
    axios.post('/follow/{{ $user->id }}')
        .then(res => {
            console.log(res.data)
            this.following = !this.following;
            this.followersCount = res.data.followersCount
        })
        .catch(err => {
            console.log(err)
        })
}

}" class="w-[320px] border-l px-8">
    {{ $slot }}
</div>

{{-- @props(['user'])

<div {{ $attributes }} x-data="{
    following: @json($user->isFollowedBy(auth()->user())),
    followersCount: @json($user->followers()->count()),
    follow() {
        this.following = !this.following;
        axios.post('{{ route('follow', $user->id) }}')
            .then(res => {
                this.followersCount = res.data.followersCount;
            })
            .catch(err => {
                console.error('An error occurred:', err);
                alert('Unable to update follow status. Please try again.');
            });
    }
}" class="w-[320px] border-l px-8">
    {{ $slot }}
</div> --}}