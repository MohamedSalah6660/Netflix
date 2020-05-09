@extends('layouts.dashboard.app')

@push('styles')

<style>
	#upload-wrapper{

		display: flex;
		justify-content: center;
		align-items: center;
		height: 25vh;
		cursor: pointer;
		flex-direction: column;
		border: 1px solid black;
	}

</style>

@endpush

@section('content')

  <h2>movies</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.movies.index') }}">movies</a></li>
    <li class="breadcrumb-item">Add Movie</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>

	<div class="tile mb-4">

		<div  id="upload-wrapper" onclick="document.getElementById('file-input').click()" 
		 style="display: {{ $errors->any() ? 'none' : 'flex' }}" >

		<i class="fa fa-video-camera fa-2x"></i>	
		<p>Click to Upload</p>
		</div>

		<input type="file" name=""
		 data-movie-id= "{{ $movie->id }}"
		 data-url = "{{ route('dashboard.movies.store') }}"
		 style="display: none" id="file-input">

		<form method="post" id="movie-properties" 
		action="{{ route('dashboard.movies.update', ['movie' => $movie->id, 'type' => 'publish']) }}"
		 style="display: {{ $errors->any() ? 'block' : 'none' }}" enctype="multipart/form-data">

			@csrf
			@method('put')

			@include('dashboard.partials._errors')
			
			<div class="form-group" style="display: {{ $errors->any() ? 'none' : 'block' }}" >
				<label id="upload-status">Uploading</label>
				<div class="progress">
				  <div class="progress-bar" id="upload-progress" role="progressbar"></div>
				</div>
			</div>

			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" id="movie-name" class="form-control" }} value="{{ old('name', $movie->name) }}">
			</div>

			<div class="form-group">
				<label>Description</label>
				<textarea name="description" class="form-control" value="{{ old('description, $movie->description') }}"></textarea>
			</div>

			<div class="form-group">
				<label>Poster</label>
				<input type="file" name="poster" class="form-control" >
			</div>

			<div class="form-group">
				<label>Image</label>
				<input type="file" name="image" class="form-control" >
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
 
	
				<button type="submit" id="submit-btn" style="display:{{ $errors->any() ? 'block' : 'none' }}" class="btn btn-info"><i class="fa fa-plus"></i>Publish Movie</button>

			</div>

		</form>
		


	</div>

@endsection