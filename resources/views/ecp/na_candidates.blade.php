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
                    <th scope="col" class="px-6 py-3">
                        Candidate Party
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Party Symbol Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                    <tr class="bg-white border-b ">
                        <td class="px-6 py-4">
                            {{ $candidate->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidate->cnic }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidate->constituency_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidate->address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidate->p_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $candidate->party_symbol_number }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="get" class="hover:cursor-pointer"
                                action="/admin/na_candidate/{{ $candidate->id }}/edit">
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
