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
            <div class="ml-0 md:ml-6 lg:ml-12">
                <a href="#" class="font-semibold text-base leading-tight hover:text-gray-400 mt-4 flex md:flex-none lg:mr-12">
                    {{ $recent['name'] }}
                </a>
                <div class="text-gray-400 mt-1 flex md:flex-none mr-6 lg:mr-12">
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
    // skeleton loading
   @for ($i = 0; $i <3 ; $i++)
   <div class="game bg-gray-800 rounded-lg shadow-md flex flex-col md:flex-row px-6 py-6">
        <div class="relative flex justify-center md:flex-none">
            <div class="bg-gray-700 w-48 h-56"></div>
        </div>
        <div class="ml-0 md:ml-6 lg:ml-12">
            <div class="md:inline-block text-transparent bg-gray-700 font-semibold text-lg leading-tight mt-4  justify-center md:flex-none lg:mr-12 rounded">
                title goes here
            </div>
                <div class="md:block w-20 h-4 text-transparent bg-gray-700 mt-1 flex justify-center md:flex-none lg:mr-12 rounded ">
                    <div>Ps4, PC, Console</div>
                </div>
            <div class="mt-6 bg-gray-700 text-transparent hidden md:block rounded">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat a maxime nemo
                repellat repellendus cupiditate nobis facere expedita iste explicabo vitae adipisci,
                in eum neque error nesciunt quo corrupti maiores distinctio ut officia natus tempora
                quos doloremque. Ex facilis velit tenetur possimus provident quisquam corrupti consequuntur
                quibusdam earum distinctio. Mollitia.
            </div>
        </div>
    </div>
   @endfor

    @endforelse
</div>
