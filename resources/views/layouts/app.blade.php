<html>

<head>
    <title>App Name - @yield('title')</title>
</head>

<body>
    <nav>
	<div class="logo_container">

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
