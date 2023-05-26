@extends('layouts.app')

@section('title', 'Login Page')


@section('content')


    <div class="bg-gray-200 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col  items-center relative">
        <h1>ECP Login</h1>
        @if ($errors->any())
            <div class="text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="flex flex-col" method="POST" action="/admin/login">
            @csrf
            <input name="email" type="text" placeholder="Email" class="px-3 py-2 my-3">
            <input name="password" type="password" placeholder="Password" class="px-3 py-2 my-3">
            <button type="submit" class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded ">Login</button>


        </form>
    </div>

@endsection
