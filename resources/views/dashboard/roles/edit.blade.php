@extends('layouts.dashboard.app')


@section('content')

  <h2>Edit Roles</h2>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item">Edit Role</li>
{{--     <li class="breadcrumb-item active" aria-current="page">Data</li>
 --}}  </ol>
</nav>

	<div class="tile mb-4">

		<form method="post" action="{{ route('dashboard.roles.update', $role->id) }}">
			@csrf
			@method('put')

			@include('dashboard.partials._errors')

			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="{{$role->name }}">
			</div>

		<div class="form-group">
			<h4>Permissions</h4>
				
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width: 5%">#</th>
							<th style="width: 20%">Name</th>
							<th>Permissions</th>

						</tr>
					</thead>

					<tbody>
					@php

						$models = ['categories', 'users', 'settings', 'movies'];

					@endphp
					
					@foreach($models as $index => $model)

						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $model }}</td>
							<td>

								@php

								$permissions_map = ['create', 'read', 'update', 'delete'];

								@endphp

								@if($model == 'settings')
@php

								$permissions_map = ['create', 'read'];

								@endphp
									
								@endif

								<select name="permissions[]" class="form-control select2" multiple>
									
									@foreach($permissions_map as $permission_map)

										<option value="{{ $permission_map .'_'. $model }}" 

										{{ 	$role->hasPermission($permission_map .'_'. $model) ? 'selected' : ''  }}
										>

											{{ $permission_map }}

										</option>

									@endforeach

								</select>

							</td>

						</tr>


					@endforeach
						
					</tbody>


				</table>

			</div>


			<div class="form-group">
	
				<button type="submit" class="btn btn-info"><i class="fa fa-edit"></i>Update</button>

			</div>

		</form>
		


	</div>

@endsection