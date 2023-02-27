<html>

<head>
    <title>App Name - @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="flex">
        <div class="logo_container">
		<img src=":" alt="">

        </div>
        <div class="links">
            <a>Home</a>
            <a>How to Cast Vote</a>
            <a>FAQs</a>
            <a>Contact Us</a>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
