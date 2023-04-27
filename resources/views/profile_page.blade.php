@extends('layouts.app')

@section('title', 'Home')


@section('content')

    <section class="py-10">
        <div class="grid grid-cols-8">
            <section class="left p-4 col-span-2">
                <div class="avatar">
                    <div style="background-image: url(https://pbs.twimg.com/media/FjU2lkcWYAgNG6d.jpg); background-size: cover;"
                        class="h-48 rounded-full  w-48">
                    </div>
                    <div class="column p-6">
                        <h3 class="text-3xl">Saad Orakzai</h3>
                        <h4 class="text-gray-500 hover:text-black hover:cursor-pointer my-2">Lead Developer</h4>
                        <div class="my-2">
                            <a href="">Voting Pass</a>
                        </div>
                        <div class="my-2">
                            <a href="">Change Password</a>
                        </div>
                        <div class="my-2">
                            <a class="text-red-500 font-semibold" href="">Verification Status: Not Verified</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-span-4 mx-6">
                <div class="form-container shadow-xl px-4 py-6 rounded-md">
                    <h3 class="my-4 font-semibold text-lg">My Info</h3>
                    <form>
                        <form class="w-full max-w-lg">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-first-name">
                                        First Name
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        id="grid-first-name" type="text" placeholder="Saad">
                                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-last-name">
                                        Last Name
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-last-name" type="text" placeholder="Orakzai">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-password">
                                        Password
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-password" type="password" placeholder="******************">
                                    <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-city">
                                        City
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-city" type="text" placeholder="Hangu">
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-zip">
                                        Zip
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        id="grid-zip" type="text" placeholder="90210">
                                </div>
                            </div>
                        </form>
                    </form>
                </div>
            </section>
            <section class="info-section col-span-2 mx-4">
                <div class="notification-section">
                    <h2>Notifications</h2>
                    <div class="notification bg-slate-200 p-4 rounded-lg my-4 mr-7">
                        Elections Will Start on 19 May 2023
                    </div>
                </div>
                <div class="login-info">
                    <h2>Security</h2>

                    <div role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
				3 Devices Using Your Account
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 underline">
                            <a href="">We have detected that 3 devices are using this account (Click to See Whether these devices are yours or not)</a>
                        </div>
                    </div>
                </div>
		<div class="my-6">
		</div>
                <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                    </svg>
                    <p>If you think someone else might be using your account, then change password and report</p>
                </div>
        </div>
    </section>
    </div>
    </section>
@endsection
