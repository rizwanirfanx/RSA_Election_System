
@extends('layouts.app')

@section('title', 'Home')


@section('content')

    <div class="relative overflow-x-auto rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-800 uppercase bg-gray-100 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Candidate Party Symbol
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Candidate Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number of Votes
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($party_votes as $pv)
                    <tr class="bg-white border-b ">
                        <td class="px-6 py-4">
                            {{ $pv->party_symbol_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pv->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pv->number_of_votes}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
