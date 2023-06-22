<x-layout>

    <div class="relative overflow-x-auto rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-800 uppercase bg-gray-100 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Candidate Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Candidate CNIC
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Candidate Constituency Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Candidate Address
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voters as $voter)
                    <tr class="bg-white border-b ">
                        <td class="px-6 py-4">
                            {{ $voter->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $voter->cnic }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $voter->email }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="get" class="hover:cursor-pointer"
                                action="/admin/na_voter/{{ $voter->id }}/edit">
                                @csrf
                                <input type="submit" value="Edit" class="text-blue-600 hover:cursor-pointer" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
