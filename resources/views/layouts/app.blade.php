<html>

<head>
    <title>App Name - @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="flex items-center justify-between w-11/12 m-auto ">
        <div class="logo_container">
            <img width="100px" src="{{ Vite::asset('resources/images/ecp_logo.png') }}">


        </div>
        <div class="links">
            <a href="/" class="p-2 hover:to-green-100">Home</a>
            <a href="/voter-verification" class="p-2">Vote</a>
            <a href="/register" class="p-2">Register</a>
        </div>
    </nav>
    <div class="">
        @yield('content')
    </div>
</body>
<footer class="fixed bottom-0 text-center">
	<div class="text-center">Election System Developed by RSA Team</div>
</footer>

</html>
