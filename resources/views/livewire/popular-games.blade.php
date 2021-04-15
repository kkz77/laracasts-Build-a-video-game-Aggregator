<div wire:init="loadPopularGames" class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
@forelse ($popularGames as $popularGame)
        <div class="game mt-8 ml-14 lg:ml-0">
            <div class="relative inline-block">
                <a href="#">
                    <img src= "{{ Str::replaceFirst('thumb', 'cover_big',  $popularGame['cover']['url'])  }} " alt="pubg" class="hover:opacity-75 transition duration-150 ease-in-out h-56 w-44">
                </a>
                <div class="absolute bottom-0 right-0 w-16 h-16 rounded-full bg-gray-800" style="right:-20px; bottom: -20px">
                    <div class="font-semibold text-xs flex items-center justify-center h-full">
                        {{ round($popularGame['rating']).'%' }}
                    </div>
                </div>
            </div>
            <a href="#" class="block font-semibold text-base leading-tight hover:text-gray-400 mt-8">
                {{ $popularGame["name"] }}
            </a>
            <div class="text-gray-400 mt-1">
                @foreach ($popularGame['platforms'] as $platform)
                    @if (array_key_exists('abbreviation', $platform))
                        {{ $platform['abbreviation'] }},
                    @endif
                @endforeach
            </div>
        </div>
    @empty
    <div class="spinner mt-8"></div>
@endforelse
</div>
