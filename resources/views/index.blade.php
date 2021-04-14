@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4">
        <!-- popular games -->
        <h2 class="text-blue-500 tracking-wide font-semibold uppercase">
            Popular Games
        </h2>
        <div class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
        @foreach ($popularGames as $popularGame)
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
        @endforeach
        </div>
        <!-- end popular games -->
        <div class="flex flex-col lg:flex-row my-10">
            <!-- recently reviewed games -->
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="font-semibold text-blue-500 uppercase tracking-wide">Recently Reviewed</h2>
                <div class="recently-reviewed-container space-y-12 mt-8">
                    @foreach ($recentlyReviewed as $recent)
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
                                    {{ $recent['summary'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
           </div>
           <!-- end recently reviewed games -->
           <div class="most-anticipated mt-12 lg:mt-0 lg:w-1/4 space-y-14">
            <!-- most-anticipated games -->
                <div>
                    <h2 class="font-semibold text-blue-500 uppercase tracking-wide">Most Aggregated</h2>
                    <div class="most-anticipated-container space-y-10 mt-8">
                        @foreach ($mostAnticipated as $game)
                            <div class="game flex space-x-4">
                                <a href="#">
                                    <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="rdr2" class="w-16 h-20 hover:opacity-75 transition duration-150 ease-in-out " >
                                </a>
                                <div>
                                    <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                                    <div class="text-gray-400 text-sm mt-1">{{ Carbon\Carbon::parse($game['first_release_date'])->format('M,d, Y') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            <!-- end most-anticipated games -->
                <div>
                    <h2 class="font-semibold text-blue-500 uppercase tracking-wide">Coming Soon</h2>
                        <div class="most-anticipated-container space-y-10 mt-8">

                            @foreach ($comingSoon as $game)
                                <div class="game flex space-x-4">
                                    <a href="#">
                                        <img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="rdr2" class="w-16 hover:opacity-75 transition duration-150 ease-in-out">
                                    </a>
                                    <div>
                                        <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                                        <div class="text-gray-400 text-sm mt-1">{{ Carbon\Carbon::parse($game['first_release_date'])->format('M,d, Y') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
            <!-- end most-anticipated games -->
        </div>
    </div>
    <!-- end container -->
@endsection
