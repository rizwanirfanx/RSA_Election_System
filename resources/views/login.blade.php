@extends('layouts.app')

@section('title', 'Registration Page')


@section('content')
    <div class="bg-gray-200 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col  items-center relative">
        <div class="absolute -top-10 py-4 px-10 bg-gray-50 rounded-full">

            <svg class="fill-green-900 " xmlns="http://www.w3.org/2000/svg"
                height="100" viewBox="0 96 960 960" width="48">
                <path
                    d="M489 936v-60h291V276H489v-60h291q24 0 42 18t18 42v600q0 24-18 42t-42 18H489Zm-78-185-43-43 102-102H120v-60h348L366 444l43-43 176 176-174 174Z" />
            </svg>
        </div>
	<h1>Login to Cast Vote</h1>

        <form class="flex flex-col">
            <input type="text" placeholder="Email or CNIC" class="px-3 py-2 my-3">
            <input type="text" placeholder="Password" class="px-3 py-2 my-3">
            <button type="submit" class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded ">Login</button>

        </form>
    </div>

@endsection
