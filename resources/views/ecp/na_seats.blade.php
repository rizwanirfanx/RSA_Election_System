<x-layout>

    <div class="relative overflow-x-auto rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-800 uppercase bg-gray-100 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Constituency Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Constituency Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Province
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($na_seats as $na_seat)
                    <tr class="bg-white border-b ">
                        <td class="px-6 py-4">
                            {{ $na_seat->constituency_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $na_seat->constituency_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $na_seat->province }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>

