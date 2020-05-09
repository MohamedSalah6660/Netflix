@extends('layouts.dashboard.app')

@section('content')

  <h2>Categories</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item">Categories</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>


<div class="tile mb-4">

	<div class="row">

		<div class="col-12">
			
			<form action="">
				
				<div class="row">
					
					<div class="col-md-4">
						
						<div class="form-group">
							
							<input type="text" autofocus name="search" placeholder="Search" class="form-control" value="{{ request()->search }}">

						</div>

					</div> <!-- end of  col -->

						<div class="col-md-4">
							 
							 <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>

        					@if(auth()->user()->hasPermission('create_categories'))
							

							 <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>


							@endif

						</div>

				</div>

			</form>

		</div>
		
	</div>

	<div class="row">
		
		<div class="col-md-12">
		
		@if($categories->count() > 0)
	<table class="table table-hover">
				
				<thead>
					
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Movies Count</th>
					<th>Action</th>

				</tr>	

				</thead>

				<tbody>
					@foreach($categories as $index=> $category)
					<tr>
						<td>{{ $index+1 }}</td>
						<td>{{ $category->name }}</td>
						<td>{{ $category->movies->count() }}</td>
						<td>
        					@if(auth()->user()->hasPermission('update_categories'))

							<a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-info btn-sm">
								<i class="fa fa-edit">Edit</i>
							</a>
							@endif

        					@if(auth()->user()->hasPermission('delete_categories'))

						<form method="post" action="{{ route('dashboard.categories.destroy', $category->id) }}" style="display:inline-block;">
						
							@csrf
							@method('delete')
							<button type="submit" onclick="return myFunction();"  class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i>Delete</button>

							</form>

							@endif

						</td>

					</tr>
					@endforeach
				</tbody>

			</table>


		{{ $categories->appends(request()->query())->links() }}

		@else

				<h2 style="font-weight: 444">Sorry, no records found</h2>
		@endif

		</div>

	</div>

</div>

<script>
	
 function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }


</script>

@endsection