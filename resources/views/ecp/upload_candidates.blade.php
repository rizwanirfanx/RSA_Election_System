<x-layout>
    <h3> Admin Upload Page</h3>
    <form method="post" action="/admin/upload_candidates" enctype="multipart/form-data">
	    @csrf
	    <input name="candidates_csv" type="file" />
	    <input type="submit" placeholder="Submit"/>
    </form>
</x-layout>
