<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kids Fest'22</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Small CSS to Hide elements at 1520px size -->
    <style>
        /* small css for the mobile nav close */
        #nav-mobile-btn.close span:first-child {
            transform: rotate(45deg);
            top: 4px;
            position: relative;
            background: #a0aec0;
        }

        #nav-mobile-btn.close span:nth-child(2) {
            transform: rotate(-45deg);
            margin-top: 0px;
            background: #a0aec0;
        }
    </style>
</head>

<body class="overflow-x-hidden antialiased">
    <section class="relative bg-hero-bg bg-cover bg-center bg-no-repeat">
        <!-- Header Section -->
        <header class="relative z-50 w-full h-24">
            <div class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0">
                <a href="/" class="relative flex items-center inline-block h-5 h-full font-black leading-none">
                    <x-application-logo class="block h-12 w-auto md:h-20" />
                </a>

                <nav id="nav" class="absolute top-0 left-0 z-50 flex flex-col items-center justify-between hidden w-full h-64 pt-5 mt-24 text-sm text-gray-800 bg-white border-t border-gray-200 md:w-auto md:flex-row md:h-24 lg:text-base md:bg-transparent md:mt-0 md:border-none md:py-0 md:flex md:relative">
                    <div class="flex flex-col block w-full font-medium border-t border-gray-200 md:hidden">
                        <a href="{{ route('login') }}" class="w-full py-2 font-bold text-center text-pink-500">Login</a>
                        <a href="{{ route('register') }}" class="relative inline-block w-full px-5 py-3 text-sm leading-none text-center text-white bg-indigo-700 fold-bold">Get
                            Started</a>
                    </div>
                </nav>

                <div class="absolute left-0 flex-col items-center justify-center hidden w-full pb-8 mt-48 border-b border-gray-200 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                    @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="relative z-40 px-3 py-2 mr-0 text-lg font-bold text-pink-500 md:px-5 sm:mr-3 md:mt-0">Dashboard</a>
                        @else
                        <a href="{{ route('login') }}" class="relative z-40 px-3 py-2 mr-0 text-lg font-bold text-pink-500 md:px-5 sm:mr-3 md:mt-0">Login</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="relative z-40 inline-block w-auto h-full px-5 py-3 text-sm font-bold leading-none text-white transition-all transition duration-100 duration-300 bg-indigo-700 rounded shadow-md fold-bold sm:w-full lg:shadow-none hover:shadow-xl">Register
                                Now
                            </a>
                            @endif
                        @endauth
                    @endif
                </div>
                <div id="nav-mobile-btn" class="absolute top-0 right-0 z-50 block w-6 mt-8 mr-10 cursor-pointer select-none md:hidden sm:mt-10">
                    <span class="block w-full h-1 mt-2 duration-200 transform bg-gray-800 rounded-full sm:mt-1"></span>
                    <span class="block w-full h-1 mt-1 duration-200 transform bg-gray-800 rounded-full"></span>
                </div>
            </div>
        </header>
        <!-- End Header Section-->
        <div class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
        </div>
    </section>
    <!-- a little JS for the mobile nav button -->
    <script>
        if (document.getElementById('nav-mobile-btn')) {
            document.getElementById('nav-mobile-btn').addEventListener('click', function() {
                if (this.classList.contains('close')) {
                    document.getElementById('nav').classList.add('hidden');
                    this.classList.remove('close');
                } else {
                    document.getElementById('nav').classList.remove('hidden');
                    this.classList.add('close');
                }
            });
        }
    </script>
</body>

</html>