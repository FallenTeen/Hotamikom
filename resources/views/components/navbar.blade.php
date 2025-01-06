<nav class="border-gray-100 dark:bg-gray-800 dark:border-gray-700 fixed w-full grid z-50" x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.scrollY > 100">
    <div :class="{'bg-transparent text-white': !scrolled, 'bg-white text-black': scrolled}" 
         class="flex items-center justify-between p-4 max-w-full px-32 w-full transition-colors duration-300"
         x-transition:enter="transition-all ease-out duration-300" 
         x-transition:leave="transition-all ease-in duration-200">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('icons/android-chrome-512x512.png') }}" class="h-16" alt="Hotamikom" />
            <span class="text-2xl font-semibold dark:text-white font-Dmserif">Hot Amikom</span>
        </a>

        <!-- Mobile Menu Button -->
        <div class="items-center flex gap-8">
        @if (!Auth::check())
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            <h1>Halo, {{ Auth::user()->name }}</h1>
        @endif

        <button @click="open = !open"
                :class="{'bg-transparent text-white': !scrolled, ' text-black': scrolled}"
                class="inline-flex items-center justify-end p-2 w-10 h-10 text-sm text-white rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        </div>
    </div>

    <!-- Mobile Menu with Animation -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 -translate-y-12" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
         class="w-full absolute left-0 h-screen overflow-y-auto bg-white dark:bg-gray-800 z-40" id="navbar-hamburger">
        
        <div :class="{'bg-transparent text-white': !scrolled, 'bg-white text-black': scrolled}" 
             class="flex items-center justify-between p-4 max-w-full px-32 w-full transition-colors duration-300"
             x-transition:enter="transition-all ease-out duration-300" 
             x-transition:leave="transition-all ease-in duration-200">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('icons/android-chrome-512x512.png') }}" class="h-16" alt="Hotamikom" />
                <span class="text-2xl font-semibold text-gray-900 dark:text-white font-Dmserif">Hot Amikom</span>
            </a>

            <!-- Mobile Menu Button -->
            <button @click="open = !open"
                    class="inline-flex items-center justify-end p-2 w-10 h-10 text-sm text-gray-900 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <ul class="flex flex-col font-medium bg-none dark:bg-gray-800 dark:border-gray-700 space-y-6 px-16 py-8">
    <li>
        <a href="{{ route('index') }}" 
           class="block py-2 px-3 text-6xl font-Dmserif rounded 
                  {{ request()->is('index') ? 'text-blue-600 dark:bg-blue-600' : 'text-gray-900 dark:bg-gray-800' }}"
           aria-current="page">Home</a>
    </li>
    <li>
        <a href="{{ route('room') }}" 
           class="block py-2 px-3 text-6xl font-Dmserif rounded 
                  {{ request()->is('room') ? 'text-blue-600 dark:bg-blue-600' : 'text-gray-900 dark:bg-gray-800' }}"
           aria-current="page">Room</a>
    </li>
    <li>
        <a href="{{ route('res') }}" 
           class="block py-2 px-3 text-6xl font-Dmserif rounded 
                  {{ request()->is('res') ? 'text-blue-600 dark:bg-blue-600' : 'text-gray-900 dark:bg-gray-800' }}"
           aria-current="page">Reservasi</a>
    </li>
</ul>

    </div>
</nav>
