<html>

<head>
    <title>E-Voting @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="relative">
    <img src="{{ asset('images/header.png') }}" />
    <div class="">
        <!-- Large Screen Header -->
        <header class="w-full  xsm:hidden">
            <nav class="border-gray-200 px-4 lg:px-6 py-2.5 w-full">
                <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                    <a href="/" class="flex items-center">
                        <span class="self-center text-3xl font-semibold whitespace-nowrap ">RSA</span>
                    </a>
                    @auth

                        <div class="flex items-center lg:order-2">
                            <a href="/profile"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">
                                {{ Auth::user()->name }}</a>
                            <a href="/logout"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">
                                Log Out</a>
                            <button data-collapse-toggle="mobile-menu-2" type="button"
                                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 "
                                aria-controls="mobile-menu-2" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endauth
                    @guest
                        <div class="flex items-center lg:order-2">
                            <a href="/login"
                                class="text-white hover:text-green-900 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">Log
                                in</a>
                            <a href="/register"
                                class="bg-white text-green-900 hover:bg-green-800 hover:text-white font-bold focus:ring-4 focus:ring-primary-300 rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">Register
                                As Voter</a>
                        </div>
                    @endguest
                    <div class="hidden justify-between items-center lg:flex lg:w-auto lg:order-1">
                        <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="/"
                                    class="block py-2 pr-4 pl-3 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 lg:lg:">Home</a>
                            </li>
                                <a href="/about-us"
                                    class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 "
                                    aria-current="page">About Us</a>
                            </li>
                            </li>
                                <a href="/display_results"
                                    class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 "
                                    aria-current="page">Results</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <header class="hidden">
            <nav class="w-screen flex justify-between px-2 items-center">
                <img src="{{ asset('images/gov_white_logo.png') }}" class="mr-3 h-16" alt="RSA Logo" />
                <div>
                    <button class="" id="mobile-menu-toggle-button">
                        <i class="fa-solid fa-bars">
                        </i>
                    </button>
                </div>

            </nav>

            <div class="h-screen fixed w-4/5 bg-green-900 left-0 top-0 bottom-0 z-10 transition-all px-4"
                style="min-height: 100vh" id="mobile-menu">
                <img src="{{ asset('images/gov_white_logo.png') }}" class="mr-3 mt-3 h-32" alt="RSA Logo" />
                <div class="mt-4"></div>
                <div class="nav-link my-2">
                    <i class="fa-solid fa-person mr-2"></i>
                    <a>Registration</a>
                </div>
            </div>
        </header>
        @yield('content')
    </div>
</body>
<x-footer></x-footer>
<script>
    const mobileMenu = document.getElementById('mobile-menu')
    const mobileMenuToggleButton = document.getElementById('mobile-menu-toggle-button')
    mobileMenuToggleButton.addEventListener('click', (e) => {
        mobileMenu.classList.toggle('-translate-x-full')
    })
</script>



</html>
