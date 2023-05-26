<x-voter-layout>

    <div class="bg-gray-200 w-4/6 mx-auto py-40 px-6 rounded flex flex-col   items-center relative mt-14">
        <i class="fa-solid fa-badge-check"></i>
        <h1 class="text-2xl mb-6">Voter Verification</h1>
        <div class="text-center">
            <p>Please Enter your personal Voter Pass that was sent to your registered Email Address</p>
        </div>
        <form action="/vote" method="GET" class="flex flex-col w-3/4 my-8">
            <label for="cnic">CNIC</label>
            <input id="cnic" type="text" placeholder="CNIC" class="px-3 py-2 my-3">
            <label for="voter_pass">Voter Pass</label>
            <input id="voter_pass" type="text" placeholder="Voter Pass" class="px-3 py-2 my-3">
            <button type="submit" class="my-3 bg-green-900 hover:bg-green-600 text-white px-3 py-2 rounded ">Verify &
                Continue</button>

        </form>
    </div>


</x-voter-layout>
