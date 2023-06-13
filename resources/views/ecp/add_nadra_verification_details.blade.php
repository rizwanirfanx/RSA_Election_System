<x-layout>

    <section class="col-span-4 mx-6 bg-gray-100 rounded-lg">
        <div class="form-container shadow-xl px-4 py-6 rounded-md">
            <h3 class="my-4 font-semibold text-lg">Add Verification Details</h3>
            <form action="/admin/add_nadra_verification_details" method="POST">
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
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            CNIC
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="xxxxx-xxxxxxx-x" name="cnic">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Mother Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Rozeena" name="mother_name">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Name of CNIC Holder
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Name" name="name">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Phone Number
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="031x-xxxxxx (Registered on your Fingerprint)" name="phone_number">
                    </div>
                </div>


                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cnic-expiry">
                    CNIC Expiry Date
                </label>

                <input id="cnic-expiry" type="date" class="p-2 bg-gray-200 text-gray-700" name="cnic_expiry_date" />

                <div class="w-1/2 mt-4">
                    <label for="constituency" class="block mb-2 text-sm font-medium text-gray-900 ">Select
                        NA Constituency</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        name="na_constituency_number">
                        @foreach ($na_constituencies as $na_constituency)
                            <option value="{{ $na_constituency->constituency_number }}">
                                {{ $na_constituency->constituency_number }} {{ $na_constituency->constituency_name }}
                            </option>
                        @endforeach
                    </select>


                </div>
                <div class="w-1/2 mt-4">
                    <label for="constituency" class="block mb-2 text-sm font-medium text-gray-900 ">Select PA
                        Constituency</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        name="pa_constituency_number">
                        @foreach ($pa_constituencies as $pa_constituency)
                            <option value="{{ $pa_constituency->ps_constituency }}">
                                {{ $pa_constituency->ps_constituency }} {{ $pa_constituency->ps_area_name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="mt-8">

                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">
                        Add Verification Details</button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
