<x-layout>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        NA Constituency
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Winner Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Party Symbol
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <a
														href="/admin/display_results/{{ $result->na_constituency_number }}"
						class="underline text-blue-700 font-bold"
														>
                                {{ $result->na_constituency_number }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $result->winner_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $result->party_symbol_number }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="relative overflow-x-auto mt-5">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        PA Constituency
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Winner Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Party Symbol
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pa_results as $result)
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $result->pa_code }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $result->winner_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $result->party_symbol_number }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-slot:script>
        <script>
            console.log('Hello');
        </script>
        </x-slot>

</x-layout>
