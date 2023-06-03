@extends('layouts.app')

@section('title', 'Registration Page')


@section('content')

    <div class="bg-gray-200 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col  items-center relative">
        <div class="absolute -top-10 py-4 px-10 bg-gray-50 rounded-full">

            <svg class="fill-green-900 " xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 96 960 960" width="48">
                <path
                    d="M489 936v-60h291V276H489v-60h291q24 0 42 18t18 42v600q0 24-18 42t-42 18H489Zm-78-185-43-43 102-102H120v-60h348L366 444l43-43 176 176-174 174Z" />
            </svg>
        </div>
        <h1 class="my-4 text-xl font-bold">Register to on Vote</h1>
        <div class="">

            <p>Create Voting account to register for Online Voting & become able to cast vote from any part of the world</p>
            <p class="font-bold mt-4">Note</p>
            <p>This voting system can be used by all Pakistani</p>
            <p class="mt-4">In order to create an account, you must have</p>
            <ul class="list-disc ml-8">
                <li>National ID Card</li>
                <li>Be 18 years or Above - at the time of registration</li>
            </ul>
        </div>
        <div class="warning_box bg-red-300 p-8 my-6 w-3/4 rounded-lg">
            <p><span class="font-bold">Attention: </span>Registering as an Voter without the consent of the Holder of CNIC
                is illegal and will lead to criminal persecution</p>
        </div>
        @if ($errors->any())
            <div class="warning_box bg-red-300 p-8 my-6 w-3/4 rounded-lg">
                <h3 class="font-bold">Errors</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/register" class="flex flex-col w-5/6 ">
            @csrf
            <label for="name">Full Name</label>
            <input name="name" value="{{ old('name') }}" id="name" type="text" placeholder="Full Name"
                class="px-3 py-2 my-3">
            <label for="cnic">CNIC With Dashes</label>
            <input value="{{ old('cnic') }}" name="cnic" id="cnic" type="text" placeholder="CNIC"
                class="px-3 py-2 my-3">
            <label for="email">Email</label>
            <input name="email" id="email" type="email" value="{{ old('email') }}" placeholder="Email"
                class="px-3 py-2 my-3">
            <label for="retype_email">Re Type Email</label>
            <input value="{{ old('email') }}" name="retyped_email" id="retype_email" type="email"
                placeholder="ReType Email" class="px-3 py-2 my-3">
            <label for="password">Password</label>
            <input value="{{ old('password') }}" name="password" id="password" type="password" placeholder="Password"
                class="px-3 py-2 my-3">
            <label for="retype_password">ReType Password</label>
            <input value="{{ old('password') }}" name="retyped_password" id="retype_password" type="password"
                placeholder="Re Type Password" class="px-3 py-2 my-3">
            <label for="phone_number">Phone Number</label>
            <input value="{{ old('phone_number') }}" name="phone_number" id="phone_number" type="text"
                placeholder="Phone Number" class="px-3 py-2 my-3">

            <button type="submit"
                class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded ">Register</button>
            <p class="text-gray-600 text-center">Already have an account?</p>
            <a href="/login" type="submit"
                class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded text-center">Login</a>
        </form>
    </div>
@endsection
