<x-voter-layout>

    <div class="bg-gray-200 w-4/6 mx-auto mt-5 py-40 px-6 rounded flex flex-col  items-center relative ">
        <div class="absolute -top-10 py-4 px-10 bg-gray-50 rounded-full">

            <svg class="fill-green-900 " xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 96 960 960"
                width="48">
                <path
                    d="M489 936v-60h291V276H489v-60h291q24 0 42 18t18 42v600q0 24-18 42t-42 18H489Zm-78-185-43-43 102-102H120v-60h348L366 444l43-43 176 176-174 174Z" />
            </svg>
        </div>

        <div class="w-full max-w-lg bg-white border border-gray-200 rounded-lg shadow sm:p-8 ">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 ">Candidates in your Constituency</h5>
                <a href="#" class="text-sm font-medium text-blue-600 hover:underline ">
                    View all
                </a>
            </div>
            @if (count($candidates) == 0)
                No Candidates in your Constituency
            @else
                @foreach ($candidates as $candidate)
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 ">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0 ml-4 ">
                                        <p class="text-sm font-medium text-gray-900 truncate ">
                                            {{ $candidate->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate ">
                                            {{ $candidate->party_symbol_number }}
                                        </p>
                                    </div>

                                    <form method="POST" action="/cast_pa_vote">
                                        @csrf

                                        <input name="candidate_id" type="hidden" value="{{ $candidate->id }}" />
                                        <input name="pa_code" type="hidden"
                                            value="{{ $candidate->constituency_number }}" />
                                        <input type="submit" class="text-sm font-medium text-blue-600 hover:underline "
                                            value="Cast Vote" />
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            @endif


        </div>
    </div>

</x-voter-layout>
