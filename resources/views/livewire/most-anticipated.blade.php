<div wire:init="loadMostAnticipated" class="most-anticipated-container space-y-10 mt-8">
    @forelse ($mostAnticipated as $game)
        <div class="game flex space-x-4">
            <a href="#">
                <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="rdr2" class="w-16 h-20 hover:opacity-75 transition duration-150 ease-in-out " >
            </a>
            <div>
                <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                <div class="text-gray-400 text-sm mt-1">{{ Carbon\Carbon::parse($game['first_release_date'])->format('M,d, Y') }}</div>
            </div>
        </div>
    @empty
        @for ($i = 0; $i < 4; $i++)
            <div class="game flex space-x-4">
                <div class="w-16 h-20 bg-gray-700 rounded"></div>
                <div>
                    <div class="bg-gray-700 text-transparent rounded">Title goes here</div>
                    <div class="bg-gray-700 text-transparent rounded mt-1 inline-block">Dec,31, 2021</div>
                </div>
            </div>
        @endfor
    @endforelse
</div>
