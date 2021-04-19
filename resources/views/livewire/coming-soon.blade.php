<div wire:init="loadComingSoon" class="most-anticipated-container space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        <x-game-card-small :game='$game' />
    @empty
        {{-- skeleton loading --}}
        <x-game-card-small-skeleton  />
        {{--end skeleton loading --}}
    @endforelse
</div>
