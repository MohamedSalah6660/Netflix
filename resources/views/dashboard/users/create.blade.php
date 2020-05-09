@extends('layouts.dashboard.app')


@section('content')

  <h2>users</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">users</a></li>
    <li class="breadcrumb-item">Add Role</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>

	<div class="tile mb-4">

		<form method="post" action="{{ route('dashboard.users.store') }}">
			@csrf
			@method('post')

			@include('dashboard.partials._errors')

			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{ old('name') }}">
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" value="{{ old('email') }}">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" >
			</div>

			<div class="form-group">
				<label>Password Confirmation</label>
				<input type="password" name="password_confirmation" class="form-control" >
			</div>

			
			<div class="form-group">
				<label>Roles</label>

				<select name="role_id" class="form-control">
					
					@foreach($roles as $role)

						<option value="{{ $role->id }}">{{ $role->name }}</option>

					@endforeach

				</select>

				<a style="margin-top: 20px;float: right;" href="{{ route('dashboard.roles.create') }}" class="btn btn-success">Create A new Role</a>
			</div>





			<div class="form-group">
	
				<button type="submit" class="btn btn-info"><i class="fa fa-plus"></i>Create</button>

			</div>

		</form>
		


	</div>

@endsection