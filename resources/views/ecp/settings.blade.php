<x-layout>
    <form action="/admin/set_election_timing" method="POST">
				@csrf
        <div class="my-4">
            <label for="election_starting_time">Election Starting Time</label>
            <input class="p-2" type="datetime-local" id="election_starting_time" name="election_starting_time">
        </div>

        <div class="my-4">
            <label for="election_ending_time">Election Ending Time</label>
            <input class="p-2" type="datetime-local" id="election_ending_time" name="election_ending_time">
        </div>
        <input class="p-2 bg-blue-600 text-white rounded-md" type="submit" value="Start Elections" />
    </form>
</x-layout>
