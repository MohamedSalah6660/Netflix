@extends('layouts.dashboard.app')


@section('content')

  <h2>Settings</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item" active>Social Login</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>

	<div class="tile mb-4">

		<form method="post" action="{{ route('dashboard.settings.store') }}">
			@csrf
			@method('post')

			@include('dashboard.partials._errors')

			@php

				$social_sites = ['facebook' , 'google'];

			@endphp

			@foreach($social_sites as $social_site)


			<div class="form-group">
				<label class="text-capitalize">{{ $social_site }} Client ID</label>
				<input type="text" name="{{ $social_site }}_client_id" class="form-control" value="{{ setting($social_site. '_client_id') }}">
			</div>

			<div class="form-group">
				<label class="text-capitalize">{{ $social_site }} Client Secret</label>
				<input type="text" name="{{ $social_site }}_client_secret" class="form-control" value="{{ setting($social_site. '_client_secret') }}">
			</div>


			<div class="form-group">
				<label class="text-capitalize">{{ $social_site }} Redirect URL</label>
				<input type="text" name="{{ $social_site }}_redirect_url" class="form-control" value="{{ setting($social_site. '_redirect_url') }}">
			</div>

			@endforeach

			<div class="form-group">
	
				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i>Create</button>

			</div>

		</form>
		


	</div>

@endsection