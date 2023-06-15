<x-voter-layout>

    <div class="bg-gray-200 6 mx-auto mt-5 py-40 px-6 rounded flex flex-col   items-center relative">
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
                            Cast Vote
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
				{{$voter_nadra_info->na_constituency_number}}
                        </th>
                        <td class="px-6 py-4">
                            <a href="/candidates"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vote</a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
				{{$voter_nadra_info->pa_constituency_number}}
                        </th>
                        <td class="px-6 py-4">
                            <a href="/cast_pa_vote"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vote</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

</x-voter-layout>
