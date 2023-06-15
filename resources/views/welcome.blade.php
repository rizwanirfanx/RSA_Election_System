@extends('layouts.app')

@section('title', 'Home')


@section('content')

    <div 
		style="background-image: url({{ asset('images/hero.webp') }});"
		class="bg-no-repeat bg-cover py-5"
		>

        <div class="bg-gray-200 opacity-90 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col  items-center">
            <h1 class="my-3">Welcome to Online Election System for Pakistan</h1>
            <p class="my-3">This Online Voting System is open for all Pakistani who are eligible for voting</p>
            @auth
                <p>{{ Auth::user() }}</p>
            @endauth
            <div class="flex justify-around">

                <a href="/register" class="svg_container text-center px-6 py-10 rounded-full mx-3">

                    <svg class="fill-green-900 m-auto" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960"
                        width="48">
                        <path
                            d="M226 896q-28 0-47-19t-19-47q0-28 19-47t47-19q28 0 47 19t19 47q0 28-19 47t-47 19Zm0-254q-28 0-47-19t-19-47q0-28 19-47t47-19q28 0 47 19t19 47q0 28-19 47t-47 19Zm0-254q-28 0-47-19t-19-47q0-28 19-47t47-19q28 0 47 19t19 47q0 28-19 47t-47 19Zm254 254q-28 0-47-19t-19-47q0-28 19-47t47-19q28 0 47 19t19 47l-66 66Zm0-254q-28 0-47-19t-19-47q0-28 19-47t47-19q28 0 47 19t19 47q0 28-19 47t-47 19Zm-40 508v-65l243-243 65 65-243 243h-65Zm294-508q-28 0-47-19t-19-47q0-28 19-47t47-19q28 0 47 19t19 47q0 28-19 47t-47 19Zm40 239-65-65 25-25q8-8 20-8.5t20 7.5l26 26q8 8 7.5 20t-8.5 20l-25 25Z" />
                    </svg>
                    <h1>Get Registered</h1>
                </a>
                <a href="/voter-verification" class="svg_container text-center px-6 py-10 rounded-full mx-3">

                    <svg class="fill-green-900 m-auto" xmlns="http://www.w3.org/2000/svg" height="48"
                        viewBox="0 96 960 960" width="48">
                        <path
                            d="M180 976q-24 0-42-18t-18-42V718l135-149 43 43-118 129h600L669 615l43-43 128 146v198q0 24-18 42t-42 18H180Zm0-60h600V801H180v115Zm262-245L283 512q-19-19-17-42.5t20-41.5l212-212q16.934-16.56 41.967-17.28Q565 198 583 216l159 159q17 17 17.5 40.5T740 459L528 671q-17 17-42 18t-44-18Zm249-257L541 264 333 472l150 150 208-208ZM180 916V801v115Z" />
                    </svg>
                    <h1>Vote</h1>
                </a>
            </div>
            <a href="/register">
                <button class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded ">Get Started</button>
            </a>
        </div>

    </div>
@endsection
