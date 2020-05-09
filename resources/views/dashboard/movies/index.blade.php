@extends('layouts.dashboard.app')

@section('content')

  <h2>Movies</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item">Movies</li>
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
						
						<div class="form-group">
							
						<select name="category" class="form-control">
							<option value="">All Categories</option>
							@foreach($categories as $category)


								<option value="{{ $category->id }}" {{ request()->category == $category->id ? 'selected' : '' }}>
									{{ $category->name }}</option>

							@endforeach

						</select>
						</div>



					</div> <!-- end of  col -->


						<div class="col-md-4">
							 
							 <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search</button>
      						  @if(auth()->user()->hasPermission('create_movies'))

							 <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>

							 @endif

						</div>

				</div>

			</form>

		</div>
		
	</div>

	<div class="row">
		
		<div class="col-md-12">
		
		@if($movies->count() > 0)
	<table class="table table-hover">
				
				<thead>
					
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Description</th>
					<th>Categories</th>
					<th>Year</th>
					<th>Rating</th>
					<th>Action</th>

				</tr>	

				</thead>

				<tbody>
					@foreach($movies as $index=> $movie)
					<tr>
						<td>{{ $index+1 }}</td>
						<td>{{ $movie->name }}</td>
						<td>{{ Str::limit($movie->description, 50 ) }}</td>
						<td>
							@foreach($movie->categories as $category)

							<h5 style="display: inline-block;"><span class="badge badge-primary">{{ $category->name }}</span></h5>
							
							@endforeach	
						</td>
						<td>{{ $movie->year }}</td>
						<td>{{ $movie->rating }}</td>
						


						<td>
        					@if(auth()->user()->hasPermission('update_movies'))

							<a href="{{ route('dashboard.movies.edit', $movie->id) }}" class="btn btn-info btn-sm">
								<i class="fa fa-edit">Show & Edit</i>
							</a>
							@endif

        					@if(auth()->user()->hasPermission('delete_movies'))

						<form method="post" action="{{ route('dashboard.movies.destroy', $movie->id) }}" style="display:inline-block;">
						
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


		{{ $movies->appends(request()->query())->links() }}

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