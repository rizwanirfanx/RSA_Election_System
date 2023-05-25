
<x-layout>
    <h3> Admin Upload Page Political Parties</h3>
    <form method="post" action="/admin/upload_parties" enctype="multipart/form-data">
	    @csrf
	    <input name="parties_csv" type="file" />
	    <input type="submit" placeholder="Submit"/>
    </form>
</x-layout>
