<x-layout>

    <section class="col-span-4 mx-6 bg-gray-100 rounded-lg">
        <div class="form-container shadow-xl px-4 py-6 rounded-md">
            <h3 class="my-4 font-semibold text-lg">Add National Assembly Seat</h3>
            <form action="/admin/add_na_seat" method="POST">

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
                <div class="flex flex-wrap -mx-3 mb-1">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Constituency Number
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="NA-1" name="constituency_number">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-1">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Constituency Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Kohat" name="constituency_name">
                    </div>
                </div>

                <select id="countries"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    name="province">
                    <option selected value="KPK">KPK</option>
                    <option value="Sindh">Sindh</option>
                    <option value="Balochistan">Balochistan</option>
                    <option value="Islamabad">Islamabad</option>
                </select>

                <div class="mt-8">
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">
                        Add NA Seat</button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
