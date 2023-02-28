@extends('layouts.app')

@section('title', 'Voter Verification')


@section('content')
    <div class="bg-gray-200 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col   items-center relative">
        <div class="absolute -top-10 py-4 px-10 bg-gray-50 rounded-full">

            <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48">
                <path
                    d="M294 814 70 590l43-43 181 181 43 43-43 43Zm170 0L240 590l43-43 181 181 384-384 43 43-427 427Zm0-170-43-43 257-257 43 43-257 257Z" />
            </svg>
        </div>
        <h1 class="text-2xl mb-6">Voter Verification</h1>
        <div class="text-center">
            <p>Please Enter your personal Voter Pass that was sent to your registered Email Address</p>
        </div>
        <form action="/vote" method="GET" class="flex flex-col w-3/4 my-8">
            <label for="cnic">CNIC</label>
            <input id="cnic" type="text" placeholder="CNIC" class="px-3 py-2 my-3">
            <label for="voter_pass">Voter Pass</label>
            <input id="voter_pass" type="text" placeholder="Voter Pass" class="px-3 py-2 my-3">
            <button type="submit" class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded ">Verify & Continue</button>

        </form>
    </div>

@endsection
