<x-layout>
	<form action="/admin/upload_dummy_voters" method="post" enctype="multipart/form-data">
		@csrf
		<input type="file" name="dummy_voters"/>
		<input type="submit" value="Upload Dummy Voters" class="p-2 rounded-md bg-green-700 text-white"/>
	</form>
</x-layout>
