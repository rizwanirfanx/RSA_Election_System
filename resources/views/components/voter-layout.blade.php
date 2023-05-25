
<html>

<head>
    <title>{{ $title ?? 'Todo Manager' }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <section class="grid grid-cols-10">
        <div class="sidebar col-span-2 dark:bg-slate-900 text-white px-3 py-2 min-h-screen">
            <div class="flex items-center">
                <img alt="logo" src="{{ asset('images/gov_white_logo.png') }}" width="100px">
            </div>
            <div class="my-5"></div>
            <x-nav-components.nav-button title="Home" link="/" icon="fa-home" />
            <x-nav-components.nav-button title="My Info" link="/profile" icon="fa-users" />
            <x-nav-components.nav-button title="Voter Pass" link="/profile" icon="fa-users" />

        </div>
        <div class="bg-gray-300 col-span-8 ">
            <nav class="bg-gray-100 p-4">
                <div class="flex">
                    <div class="left">
                        <h3 class="font-semibold text-2xl fami">Welcome Admin 🎊</h3>
                        <p class="text-gray-800 font-light text-sm">Here is What is happening in your Elections!</p>
                    </div>
                    <div class="right">
                    </div>
                </div>
            </nav>
            <div class="mt-4 mx-4">
                {{ $slot }}
            </div>
        </div>
    </section>
</body>

</html>