<x-voter-layout>

    <div class="bg-gray-200 mx-auto py-40 px-6 rounded flex flex-col  items-center relative">
        <h1 class="text-xl font-bold">Account Verification</h1>
        <div class="">

            <p>Create Voting account to register for Online Voting & become able to cast vote from any part of the world
            </p>
            <p class="font-bold mt-4">Note</p>
            <p>This voting system can be used by all Pakistani</p>
            <p class="mt-4">In order to create an account, you must have</p>
            <ul class="list-disc ml-8">
                <li>National ID Card</li>
                <li>Be 18 years or Above - at the time of registration</li>
            </ul>
        </div>
        <div class="warning_box bg-red-300 p-8 my-6 w-3/4 rounded-lg">
            <p><span class="font-bold">Attention: </span>Registering as an Voter without the consent of the Holder of
                CNIC
                is illegal and will lead to criminal persecution</p>
        </div>
        @if ($errors->any())
            <div class="warning_box bg-red-300 p-8 my-6 w-3/4 rounded-lg">
                <h3 class="font-bold">Errors</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/verify_account" class="flex flex-col w-5/6 ">
            @csrf
            <label>Select Your Mother Name</label>
            <div class="grid grid-cols-2">
                @foreach ($nadra_data as $data)
                    <div>
                        <input id="{{ $data->mother_name }}" type="radio" name="mother_name"
                            value="{{ $data->mother_name }}" />
                        <label for="{{ $data->mother_name }}">{{ $data->mother_name }}</label>
                    </div>
                @endforeach
            </div>
            <label>Select your CNIC Expiry Date</label>
            <div class="grid grid-cols-2">
                @foreach ($nadra_data as $data)
                    <div class="">
                        <input id="{{ $data->cnic_expiry_date }}" type="radio" name="cnic_expiry_date"
                            value={{ $data->cnic_expiry_date }} />
                        <label for="{{ $data->cnic_expiry_date }}">{{ $data->cnic_expiry_date }}</label>
                    </div>
                @endforeach
            </div>
            <input type="submit" class="bg-green-800 p-2 rounded-md mt-2 w-2/5 mx-auto text-white hover:cursor-pointer " />
        </form>
    </div>

</x-voter-layout>
