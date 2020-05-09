@extends('layouts.dashboard.app')


@section('content')

  <h2>Edit movies</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.movies.index') }}">movies</a></li>
    <li class="breadcrumb-item">Edit Role</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>

	<div class="tile mb-4">
	<form method="post" id="movie-properties" 
		action="{{ route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'update']) }}"
		enctype="multipart/form-data">

			@csrf
			@method('put')

			@include('dashboard.partials._errors')
			

			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" id="movie-name" class="form-control" }} value="{{ old('name', $movie->name) }}">
			</div>

			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control" >{{ old('description', $movie->description) }}</textarea>
			</div>

			<div class="form-group">
				<label>Poster</label>
				<input type="file" name="poster" class="form-control poster" >

			</div>

			 <div class="form-group">
				<img src="{{ $movie->poster_path }}" style="width: 225px; height: 378px;margin-top: 10px" class="img-thumbnail poster-preview" alt="">
            </div>

			<div class="form-group">
				<label>Image</label>
				<input type="file" name="image" class="form-control image" >
			</div>


            <div class="form-group">
				<img src="{{ $movie->image_path }}" style="width: 225px; height: 378px; margin-top: 10px" class="img-thumbnail image-preview" alt="">
            </div>


			<div class="form-group">
				<label>Category</label>
				<select name="categories[]" class="form-control select2" multiple>
					
					@foreach($categories as $category)
						<option 
						value="{{ $category->id }}" {{ in_array($category->id, $movie->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
						{{ $category->name }}</option>

					@endforeach


				</select>

			</div>



			<div class="form-group">
				<label>Year</label>
				<input type="text" name="year" class="form-control" value="{{ old('year', $movie->year) }}" >
			</div>

			<div class="form-group">
				<label>Rating</label>
				<input type="number" min="1" name="rating" class="form-control" value="{{ old('rating', $movie->rating) }}">
			</div>
		
			<div class="form-group" >
 
	
				<button type="submit"   class="btn btn-info"><i class="fa fa-plus"></i>Edit Movie</button>

			</div>

		</form>
		


	</div>

@endsection