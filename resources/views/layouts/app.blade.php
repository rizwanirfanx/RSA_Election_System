<html>

<head>
    <title>App Name - @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="flex items-center justify-between w-11/12 m-auto bg-green-900 ">
        <div class="logo_container">
            <img width="100px" src="{{ Vite::asset('resources/images/ecp_logo.png') }}">


        </div>
        <div class="links">
            <a class="p-2">Home</a>
            <a class="p-2">How to Cast Vote</a>
            <a class="p-2">FAQs</a>
            <a class="p-2">Contact Us</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
