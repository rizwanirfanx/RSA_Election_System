@extends('layouts.app')

@section('title', 'Voting Page')


@section('content')
    <div class="bg-gray-200 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col   items-center relative">
        <div class="absolute -top-10 py-4 px-10 bg-gray-50 rounded-full">

            <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48">
                <path
                    d="M294 814 70 590l43-43 181 181 43 43-43 43Zm170 0L240 590l43-43 181 181 384-384 43 43-427 427Zm0-170-43-43 257-257 43 43-257 257Z" />
            </svg>
        </div>
        <h1 class="text-2xl mb-6">Cast Vote</h1>
        <div class="text-center">
            <p>Please Proceed to cast your vote for the available/Active Elections Being Held In Pakistan</p>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 w-3/4">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Constituency
                        </th>
                        <th scope="col" class="px-6 py-3">
				Area Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cast Vote
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
				NA-32
                        </th>
                        <td class="px-6 py-4">
				Kohat
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vote</a>
                        </td>
                    </tr>
                    <tr class="border-b bg-gray-50 ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
				NA-33
                        </th>
                        <td class="px-6 py-4">
				Peshawar
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Vote</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

@endsection
