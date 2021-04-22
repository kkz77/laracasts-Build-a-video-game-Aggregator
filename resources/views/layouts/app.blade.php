<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <livewire:styles />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>Laracasts Video Games</title>
</head>
<body class="bg-gray-900 text-white">
   <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6 space-y-6 lg:space-y-0">
            <div class="flex flex-col lg:flex-row items-center space-y-6 lg:space-y-0">
                <a href="/">
                    <img src="/images/negative-logo.svg" alt="logo" class="w-32 flex-none">
                </a>
                <ul class="flex ml-0 lg:ml-12 space-x-8">
                    <a href="{{ route('game.index') }}" class="hover:text-gray-400">Games</a>
                    <a href="#" class="hover:text-gray-400">Reviews</a>
                    <a href="#" class="hover:text-gray-400">Coming Soon</a>
                </ul>
            </div>
            <div class="flex items-center">
                <livewire:search-dropdown />
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
   <script src="/js/app.js"></script>
   @stack('scripts')
</body>
</html>
