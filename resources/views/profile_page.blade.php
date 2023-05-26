<x-voter-layout>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        My Info
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <x-info-table.table-row key="Name" :value="$user->name" />
                <x-info-table.table-row key="Email" :value="$user->email" />
                <x-info-table.table-row key="CNIC" :value="$user->cnic" />
                <x-info-table.table-row key="Phone Number" :value="$user->phone_number" />
                @if ($user_verification_status == 1)
                    <x-info-table.table-row key="Account Verification Status" value="Verified" />
                @else
                    <x-info-table.table-row key="Account Verification Status" value="Not Verified" link="/verify_account" />
                @endif
                @if ($voter_pass == null)
                    <x-info-table.table-row key="Voting Pass" value="Generate Voting Pass" link="/generate_voting_pass" id="generate_voting_pass_btn" form_method="POST"/>
                @else
                    <x-info-table.table-row key="Voting Pass" :value="$voter_pass" />
                @endif

            </tbody>
        </table>
    </div>
    <x-slot:scripts>
    	@vite('resources/js/profile_page.js')
    </x-slot:scripts>

</x-voter-layout>
