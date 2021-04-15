<div wire:init="loadRecentlyReviewed" class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $recent)
        <div class="game bg-gray-800 rounded-lg shadow-md flex flex-col md:flex-row px-6 py-6">
            <div class="relative flex justify-center md:flex-none">
                <a href="#">
                    <img src="{{ Str::replaceFirst('thumb', 'cover_big',  $recent['cover']['url'])  }}" alt="pubg" class="hover:opacity-75 transition duration-150 ease-in-out w-48 ">
                </a>
                <div class="absolute bottom-0 right-0 w-16 h-16 rounded-full bg-gray-900 hidden md:block" style="right:-20px; bottom: -20px">
                    <div class="font-semibold text-xs flex items-center justify-center h-full">80%</div>
                </div>
            </div>
            <div class="ml-6 lg:ml-12">
                <a href="#" class=" font-semibold text-base leading-tight hover:text-gray-400 mt-4 flex justify-center md:flex-none lg:mr-12">
                    {{ $recent['name'] }}
                </a>
                <div class="text-gray-400 mt-1 flex justify-center md:flex-none lg:mr-12">
                    @foreach ($recent['platforms'] as $platform)
                        @if (array_key_exists('abbreviation', $platform))
                        {{ $platform['abbreviation'] }},
                        @endif
                    @endforeach
                </div>
                <p class="mt-6 text-gray-400 hidden md:block">
                    {{ $recent['summary'] }} </p>
            </div>
        </div>
    @empty
        <div class="spinner mt-8"></div>
    @endforelse
</div>
