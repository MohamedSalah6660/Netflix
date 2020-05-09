@extends('layouts.dashboard.app')


@section('content')

  <h2>Edit Categories</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item">Edit Category</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>

	<div class="tile mb-4">

		<form method="post" action="{{ route('dashboard.categories.update', $category->id) }}">
			@csrf
			@method('put')

			@include('dashboard.partials._errors')

			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{$category->name }}">
			</div>

			<div class="form-group">
	
				<button type="submit" class="btn btn-info"><i class="fa fa-edit"></i>Update</button>

			</div>

		</form>
		


	</div>

@endsection