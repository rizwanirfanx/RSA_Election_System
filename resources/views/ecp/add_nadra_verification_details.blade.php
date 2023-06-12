<x-layout>

    <section class="col-span-4 mx-6 bg-gray-100 rounded-lg">
        <div class="form-container shadow-xl px-4 py-6 rounded-md">
            <h3 class="my-4 font-semibold text-lg">Add Verification Details</h3>
            <form action="/admin/add_na_candidate" method="POST">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            CNIC
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="xxxxx-xxxxxxx-x" name="name">
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
                            id="grid-first-name" type="text" placeholder="Rozeena" name="name">
                    </div>
                </div>


                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cnic-expiry">
                    CNIC Expiry Date
                </label>

                <input id="cnic-expiry" type="date" class="p-2 bg-gray-200 text-gray-700" />

                <div class="mt-8">

                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-blue-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none ">
                        Add Verification Details</button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
