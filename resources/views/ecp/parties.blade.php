<x-layout>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Party name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Party Sign
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Party Symbol Number
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parties as $party)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{$party->p_name}}
                        </td>
                        <td class="px-6 py-4">
				{{$party->p_sign}}
                        </td>
                        <td class="px-6 py-4">
				{{$party->p_symbol_number}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-layout>
