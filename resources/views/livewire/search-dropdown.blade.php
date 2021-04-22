<div class="relative" x-data="{ isVisible:true }" @click.away=" isVisible = false ">
    <input wire:model.debounce.300ms="search"
            type="search" class="bg-gray-800 w-48 lg:w-64 text-sm rounded-full focus:outline-none focus:shadow-outline px-3 pl-8 py-1"
            placeholder="Search(Press '/' to focus)"
            x-ref = "search"
            @focus=" isVisible = true "
            @keydown.escape.window="isVisible= false"
            @keydown = " isVisible=true "
            @keydown.shift.tab = "isVisible=false"
            @keydown.window = "
                if( event.keyCode === 191 ) {
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
    >
    <div class="absolute top-0 h-full flex items-center ml-2">
        <svg class="fill-current w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966"><path d="M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984
            23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92
             2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z"/></svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mt-3  mr-4" style="position: absolute"></div>
    <div class="absolute z-50 bg-gray-800 text-xs rounded w-48 lg:w-64 mt-2" x-show.transition.opacity.duration.200="isVisible">
    @if (strlen($search)>2)
            @if (count($searchResults)>0)
                @foreach ($searchResults as $game)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('game.show',$game['slug']) }}"
                        class="hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                        @if ($loop->last)
                           @keydown.tab = "isVisible=false"
                        @endif
                        >
                            @if (isset($game['cover']))
                                <img src="{{ $game['cover'] }}" alt="cover" class="w-10">
                            @else
                                <img src="https://via.placeholder.com/150.jpg?text={{ $game['name'] }}" alt="" class="w-16">
                            @endif
                                <span class="ml-4">{{ $game['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            @else
                <div class="px-3 py-3">No result for "{{ $search }}"</div>
            @endif
        @endif

        <ul>
        </ul>
    </div>
</div>
