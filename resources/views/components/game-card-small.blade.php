<div class="game flex space-x-4">
    <a href="{{ $game['slug'] }}">
        <img src="{{  $game['cover'] }}" alt="" class="w-16 h-20 hover:opacity-75 transition duration-150 ease-in-out " >
    </a>
    <div>
        <a href="{{ $game['slug'] }}" class="hover:text-gray-300">{{ $game['name'] }}</a>
        <div class="text-gray-400 text-sm mt-1">{{ $game['first_release_date'] }}</div>
    </div>
</div>
