<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <livewire:styles />
    <title>Laracasts Video Games</title>
</head>
<body class="bg-gray-900 text-white">
   <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6 space-y-6 lg:space-y-0">
            <div class="flex flex-col lg:flex-row items-center space-y-6 lg:space-y-0">
                <a href="/">
                    <img src="/images/negative-logo.svg" alt="logo" class="w-32 flex-none">
                </a>
                <ul class="flex ml-0 lg:ml-16 space-x-8">
                    <a href="{{ route('game.index') }}" class="hover:text-gray-400">Games</a>
                    <a href="#" class="hover:text-gray-400">Reviews</a>
                    <a href="#" class="hover:text-gray-400">Coming Soon</a>
                </ul>
            </div>
            <div class="flex items-center">
                <div class="relative">
                    <input type="search" class="bg-gray-800 w-48 lg:w-64 text-sm rounded-full focus:outline-none focus:shadow-outline px-3 pl-8 py-1" placeholder="Search..." >
                    <div class="absolute top-0 h-full flex items-center ml-2">
                        <svg class="fill-current w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966"><path d="M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984
                            23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92
                             2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z"/></svg>
                    </div>
                </div>
                <div class="ml-6">
                    <a href="#"><img src="/images/hacker.jpg" alt="avatar" class="rounded-full w-9 h-9 "></a>
                </div>
            </div>
        </nav>
    </header>
   <main class="py-8">
        @yield('content')
   </main>
   <footer class="border-t border-gray-800">
       <div class="container mx-auto px-4 py-6 text-center">
           Power By <a href="#" class="underline hover:text-gray-400">IGDB API</a>
       </div>
   </footer>
   <livewire:scripts />
</body>
</html>
