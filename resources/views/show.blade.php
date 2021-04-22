@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4">
        <div class="game-details border-b border-gray-800 pb-12 flex flex-col lg:flex-row">
            <div class="flex-none">
                @if (isset($game['cover']))
                    <img src="{{ $game['cover'] }}" alt="rdr" class="w-68 h-72">
                @else
                    <div class="bg-gray-700 w-68 h-72 flex items-center text-center justify-center text-gray-500">{{ $similar_game['name'] }}</div>
                @endif
            </div>
            <div class="lg:ml-12 mt-2 lg:mt-0">
                <h2 class="font-semibold text-4xl">
                    {{ $game['name'] }}
                </h2>
                <div class="text-gray-400">
                    <span>
                        {{ $game['genres'] }}
                    </span>
                    &middot;
                    <span>
                        {{ $game['involved_companies'] }}
                    </span>
                    &middot;
                    <span>
                        {{ $game['platforms'] }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center mt-8 lg:mr-64">
                    <div class="flex items-center mr-12 pb-2">
                        <div id="memberRating" class="w-16 h-16 bg-gray-800 rounded-full relative">
                            @push('scripts')
                               @include('_rating',[
                                   'slug' => 'memberRating',
                                   'rating' => $game['rating'],
                                   'event' => null,
                               ])
                            @endpush
                            {{-- <div class="text-xs font-semibold flex justify-center items-center h-full">
                               {{ $game['rating'] }}
                            </div> --}}

                        </div>
                        <div class="ml-4 text-xs">Member <br> Score</div>
                    </div>
                    <div class="flex items-center mr-12">
                        <div id="aggregatedRating" class="w-16 h-16 bg-gray-800 rounded-full relative">
                            @push('scripts')
                               @include('_rating',[
                                   'slug' => 'aggregatedRating',
                                   'rating' => $game['aggregated_rating'],
                                   'event' => null,
                               ])
                            @endpush
                            {{-- <div class="text-xs font-semibold flex justify-center items-center h-full">
                                {{ $game['aggregated_rating'] }}
                            </div> --}}
                        </div>
                        <div class="ml-4 text-xs">Critic <br> Score</div>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 lg:mt-0">
                        @if ($game['social']['website'])
                            <div class="h-8 w-8 rounded-full bg-gray-800 flex justify-center items-center">
                                <a href="{{ $game['social']['website']['url'] }}" target="_blank" class="hover:text-gray-400">
                                    <svg class="fill-current w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 477.73 477.73"><path d="M433.562 100.983a3.987 3.987 0 00-.051-.461c-.597-.853-1.331-1.587-1.946-2.423A244.794 244.794 0 00417.4 80.554a262.531 262.531 0 00-4.13-4.557 236.39 236.39 0 00-16.145-15.718c-1.041-.922-2.014-1.877-3.055-2.782a239.198 239.198 0 00-45.295-30.583c-.649-.341-1.331-.631-1.997-.973a237.347 237.347 0 00-22.187-9.882c-1.707-.614-3.26-1.195-4.881-1.707a241.293 241.293 0 00-20.48-6.366c-2.048-.546-4.096-1.109-6.178-1.587-6.827-1.587-13.653-2.799-20.634-3.789-2.116-.307-4.198-.717-6.332-.973a224.367 224.367 0 00-54.136 0c-2.133.256-4.215.666-6.332.973-6.98.99-13.875 2.202-20.634 3.789-2.082.478-4.13 1.041-6.178 1.587a230.801 230.801 0 00-20.48 6.366c-1.707.58-3.26 1.161-4.881 1.707a237.202 237.202 0 00-22.187 9.882c-.666.341-1.348.631-1.997.973a239.258 239.258 0 00-45.449 30.583c-1.041.904-2.014 1.86-3.055 2.782a221.975 221.975 0 00-16.145 15.718 262.531 262.531 0 00-4.13 4.557 233.62 233.62 0 00-14.165 17.544c-.614.836-1.348 1.57-1.946 2.423a3.873 3.873 0 00-.205.461c-58.866 82.497-58.866 193.267 0 275.763.058.158.126.312.205.461.597.853 1.331 1.587 1.946 2.423a238.636 238.636 0 0014.165 17.545 262.531 262.531 0 004.13 4.557 241.8 241.8 0 0016.145 15.718c1.041.922 2.014 1.877 3.055 2.782a239.198 239.198 0 0045.295 30.583c.649.341 1.331.631 1.997.973a237.347 237.347 0 0022.187 9.882c1.707.614 3.26 1.195 4.881 1.707a241.293 241.293 0 0020.48 6.366c2.048.546 4.096 1.109 6.178 1.587 6.827 1.587 13.653 2.799 20.634 3.789 2.116.307 4.198.717 6.332.973a224.367 224.367 0 0054.136 0c2.133-.256 4.215-.666 6.332-.973 6.98-.99 13.875-2.202 20.634-3.789 2.082-.478 4.13-1.041 6.178-1.587a228.456 228.456 0 0020.48-6.366c1.707-.58 3.26-1.161 4.881-1.707a237.202 237.202 0 0022.187-9.882c.666-.341 1.348-.631 1.997-.973a239.245 239.245 0 0045.295-30.583c1.041-.905 2.014-1.86 3.055-2.782a217.289 217.289 0 0016.145-15.718 262.531 262.531 0 004.13-4.557 238.375 238.375 0 0014.165-17.545c.614-.836 1.348-1.57 1.946-2.423.078-.149.147-.303.205-.461 58.866-82.495 58.866-193.265 0-275.762zm-19.473 32.291a203.074 203.074 0 0128.791 88.525H340.651a318.467 318.467 0 00-9.557-60.228 306.684 306.684 0 0082.995-28.297zM282.368 38.775c.956.222 1.877.529 2.833.751 6.11 1.434 12.169 3.072 18.091 5.12.905.307 1.792.666 2.68.99a229.53 229.53 0 0117.323 6.827c.99.461 1.963.973 2.953 1.434a220.423 220.423 0 0115.906 8.38l3.413 2.065a198.427 198.427 0 0114.336 9.643c1.195.87 2.389 1.707 3.567 2.662a155.714 155.714 0 0113.073 10.974c1.092.99 2.219 1.963 3.294 2.987 4.369 4.147 8.533 8.533 12.561 13.073.512.597 1.058 1.143 1.57 1.707a286.275 286.275 0 01-72.789 23.381 433.96 433.96 0 00-45.943-91.17c2.37.426 4.794.665 7.132 1.176zm-111.07 183.023a284.761 284.761 0 019.387-54.613 489.047 489.047 0 0058.266 3.413 490.158 490.158 0 0058.317-3.499 284.239 284.239 0 019.335 54.699H171.298zm135.305 34.134a284.761 284.761 0 01-9.387 54.613 489.047 489.047 0 00-58.266-3.413 490.32 490.32 0 00-58.317 3.413 284.313 284.313 0 01-9.336-54.613h135.306zM238.95 45.193a412.205 412.205 0 0147.565 88.747 451.706 451.706 0 01-47.565 2.526 455.121 455.121 0 01-47.514-2.543 415.453 415.453 0 0147.514-88.73zm-153.429 58.47c4.011-4.54 8.192-8.926 12.561-13.073 1.075-1.024 2.202-1.997 3.294-2.987a211.532 211.532 0 0113.073-10.974c1.178-.905 2.372-1.707 3.567-2.662a206.266 206.266 0 0114.336-9.643l3.413-2.065a203.843 203.843 0 0115.906-8.38c.99-.461 1.963-.973 2.953-1.434a193.056 193.056 0 0117.323-6.827c.887-.324 1.707-.683 2.679-.99 5.922-1.98 11.947-3.618 18.091-5.12.956-.222 1.877-.529 2.85-.734 2.338-.512 4.762-.751 7.134-1.178a433.99 433.99 0 00-45.961 91.187 286.262 286.262 0 01-72.789-23.381c.512-.596 1.058-1.142 1.57-1.739zm-21.709 29.611a306.63 306.63 0 0082.978 28.297 318.465 318.465 0 00-9.54 60.228H35.021a203.1 203.1 0 0128.791-88.525zm0 211.183a203.074 203.074 0 01-28.791-88.525H137.25a318.467 318.467 0 009.557 60.228 306.616 306.616 0 00-82.995 28.297zm131.721 94.498c-.956-.222-1.877-.529-2.833-.751-6.11-1.434-12.169-3.072-18.091-5.12-.905-.307-1.792-.666-2.68-.99a229.53 229.53 0 01-17.323-6.827c-.99-.461-1.963-.973-2.953-1.434a220.423 220.423 0 01-15.906-8.38l-3.413-2.065a198.427 198.427 0 01-14.336-9.643c-1.195-.87-2.389-1.707-3.567-2.662a155.714 155.714 0 01-13.073-10.974c-1.092-.99-2.219-1.963-3.294-2.987-4.369-4.147-8.533-8.533-12.561-13.073-.512-.597-1.058-1.143-1.57-1.707a286.275 286.275 0 0172.789-23.381 433.96 433.96 0 0045.943 91.17c-2.371-.425-4.794-.664-7.132-1.176zm43.417-6.417a412.205 412.205 0 01-47.565-88.747 444.302 444.302 0 0195.095 0l-.017.017a415.363 415.363 0 01-47.513 88.73zm153.43-58.471c-4.011 4.54-8.192 8.926-12.561 13.073-1.075 1.024-2.202 1.997-3.294 2.987a203.398 203.398 0 01-13.073 10.974 176.488 176.488 0 01-3.567 2.662 206.266 206.266 0 01-14.336 9.643l-3.413 2.065a207.805 207.805 0 01-15.906 8.38c-.99.461-1.963.973-2.953 1.434a193.056 193.056 0 01-17.323 6.827c-.887.324-1.707.683-2.679.99-5.922 1.98-11.947 3.618-18.091 5.12-.956.222-1.877.529-2.85.734-2.338.512-4.762.751-7.134 1.178a433.912 433.912 0 0045.943-91.17 286.262 286.262 0 0172.789 23.381c-.494.579-1.04 1.125-1.552 1.722zm21.709-29.61a306.63 306.63 0 00-82.978-28.297 318.465 318.465 0 009.54-60.228H442.88a203.108 203.108 0 01-28.791 88.525z"/></svg>
                                </a>
                            </div>
                        @endif

                        @if ($game['social']['facebook'])
                            <div class="h-8 w-8 rounded-full bg-gray-800 flex justify-center items-center">
                                <a href="{{ $game['social']['facebook'][0]['url'] }}" target="_blank" class="hover:text-gray-400">
                                    <svg class="w-6 h-6 fill-current" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M6.812 13.937H9.33v9.312c0 .414.335.75.75.75l4.007.001a.75.75 0 00.75-.75v-9.312h2.387a.75.75 0 00.744-.657l.498-4a.75.75 0 00-.744-.843h-2.885c.113-2.471-.435-3.202 1.172-3.202 1.088-.13 2.804.421 2.804-.75V.909a.75.75 0 00-.648-.743A26.926 26.926 0 0015.071 0c-7.01 0-5.567 7.772-5.74 8.437H6.812a.75.75 0 00-.75.75v4c0 .414.336.75.75.75zm.75-3.999h2.518a.75.75 0 00.75-.75V6.037c0-2.883 1.545-4.536 4.24-4.536.878 0 1.686.043 2.242.087v2.149c-.402.205-3.976-.884-3.976 2.697v2.755c0 .414.336.75.75.75h2.786l-.312 2.5h-2.474a.75.75 0 00-.75.75V22.5h-2.505v-9.312a.75.75 0 00-.75-.75H7.562z"/></svg>
                                </a>
                            </div>
                        @endif

                        @if ($game['social']['instagram'])
                            <div class="h-8 w-8 rounded-full bg-gray-800 flex justify-center items-center">
                            <a href="{{ $game['social']['instagram'][0]['url'] }}" target="_blank" class="hover:text-gray-400">
                                <svg class="fill-current w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M352 0H160C71.648 0 0 71.648 0 160v192c0 88.352 71.648 160 160 160h192c88.352 0
                                     160-71.648 160-160V160C512 71.648 440.352 0 352 0zm112 352c0 61.76-50.24 112-112 112H160c-61.76 0-112-50.24-112-112V160C48 98.24 98.24 48 160 48h192c61.76
                                     0 112 50.24 112 112v192z"/><path d="M256 128c-70.688 0-128 57.312-128 128s57.312 128 128 128 128-57.312 128-128-57.312-128-128-128zm0 208c-44.096 0-80-35.904-80-80
                                     0-44.128 35.904-80 80-80s80 35.872 80 80c0 44.096-35.904 80-80 80z"/><circle cx="393.6" cy="118.4" r="17.056"/></svg>
                            </a>
                        </div>
                        @endif

                        <div class="h-8 w-8 rounded-full bg-gray-800 flex justify-center items-center">
                            <a href="#" class="hover:text-gray-400">
                                <svg class="fill-current w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="mt-12">
                        <p>{{ $game['summary'] }}</p>
                    </div>
                    <div class="mt-6" x-data="{ isTrailerModalVisible:false }">
                        <button class="flex bg-blue-500 text-white font-semibold rounded px-4 py-4 hover:bg-blue-600 transition duration-150 ease-in-out"
                                @click=" isTrailerModalVisible = true"
                        >
                            <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 494.148 494.148"><path d="M405.284 201.188L130.804 13.28C118.128 4.596 105.356 0 94.74 0 74.216 0 61.52 16.472 61.52 44.044v406.124c0 27.54 12.68 43.98 33.156 43.98 10.632 0 23.2-4.6 35.904-13.308l274.608-187.904c17.66-12.104 27.44-28.392 27.44-45.884.004-17.48-9.664-33.764-27.344-45.864z"/></svg>
                            <span class="ml-2">Play Trailer</span>
                        </button>
                        {{-- <a href="https://youtube.com/watch/{{ $game['videos']  }} " target="_blank" class="flex bg-blue-500 text-white font-semibold rounded px-4 py-4 hover:bg-blue-600 transition duration-150 ease-in-out">
                            <svg class="w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 494.148 494.148"><path d="M405.284 201.188L130.804 13.28C118.128 4.596 105.356 0 94.74 0 74.216 0 61.52 16.472 61.52 44.044v406.124c0 27.54 12.68 43.98 33.156 43.98 10.632 0 23.2-4.6 35.904-13.308l274.608-187.904c17.66-12.104 27.44-28.392 27.44-45.884.004-17.48-9.664-33.764-27.344-45.864z"/></svg>
                            <span class="ml-2">Play Trailer</span>
                        </a> --}}
                        <template x-if = "isTrailerModalVisible">
                            <div
                                style="background-color: rgba(0, 0, 0, .5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                class="text-3xl leading-none hover:text-gray-300"
                                                @click = " isTrailerModalVisible = false "
                                                @keydown.escape.window = "isTrailerModalVisible = false "
                                            >&times;</button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden  relative" style="padding-top:56.25%">
                                                <iframe width="568" height="315" class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                        src="{{ $game['videos'] }}"
                                                        style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <!-- end game details -->
        <div class="images-container border-b border-gray-800 pb-12 mt-8" x-data =" { isImageModalVisible: false,image:'' } ">
            <h2 class="text-blue-500 tracking-wide font-semibold uppercase">
                Images
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mt-8">
                @foreach ($game['screenshots'] as $screenshot)
                    <a href="#"
                        @click.prevent = "
                            isImageModalVisible= true
                            image = '{{ $screenshot }}'
                        "
                    >
                        <img src="{{ $screenshot }}" alt="{{ $game['name'] }}" class="h-56 hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                @endforeach
            </div>
            <template x-if = "isImageModalVisible">
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    class="text-3xl leading-none hover:text-gray-300"
                                    @click = " isImageModalVisible = false "
                                    @keydown.escape.window = "isImageModalVisible = false "
                                >&times;</button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <img :src="image" alt="{{ $game['name'] }}">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <!-- end image container-->
        <!-- similar games container-->
        <div class="similar-games-container mt-12">
            <h2 class="text-blue-500 tracking-wide font-semibold uppercase mt-12">
                similar games
            </h2>
            <div class="similar-games container text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12">
                @foreach ($game['similar_games'] as $similar_game)
                    <div class="game mt-8 items-center">
                        @if (strpos($similar_game['cover'],'jpg'))
                        <div class="relative inline-block">
                                <a href="{{ $similar_game['slug'] }}">
                                    <img src="{{ $similar_game['cover'] }}" alt="" class="hover:opacity-75 transition duration-150 ease-in-out ">
                                </a>
                            @if ($similar_game['rating']!= 0)
                                <div id="{{ $similar_game['slug'] }}" class="absolute bottom-0 right-0 w-16 h-16 rounded-full bg-gray-800" style="right:-20px; bottom: -20px">
                                        {{-- <div class="font-semibold text-xs flex items-center justify-center h-full">
                                            {{ $similar_game['rating'] }}
                                        </div> --}}
                                </div>
                                @push('scripts')
                                    @include('_rating',[
                                        'slug' => $similar_game['slug'],
                                        'rating' => $similar_game['rating'],
                                        'event' => null,
                                    ])
                                @endpush
                            @endif
                        </div>
                        @else
                        <a href="{{ $similar_game['slug'] }}">
                            <div class="bg-gray-700 w-44 h-56 flex items-center text-center justify-center text-gray-500 hover:opacity-75 transition duration-150 ease-in-out">{{ $similar_game['name'] }}</div>
                        </a>
                        @endif
                        <a href="{{ $similar_game['slug'] }}" class="block font-semibold text-base leading-tight hover:text-gray-400 mt-8">
                            {{ $similar_game['name'] }}
                        </a>
                        <div class="text-gray-400 mt-1 inline-block">{{ $similar_game['abbreviation'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- end similar games -->
    </div>
@endsection

