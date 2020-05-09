<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
	protected $fillable = ['name'];



	public function scopewhenSearch($query, $search)
	{
		return $query->when($search ,function($q) use($search){

			return $q->where('name', 'like', "%$search%");

		});
	}

	public function scopewhereRoleNot($query, $role_name)
	{
		return $query->whereNotIn('name', (array)$role_name);



	}
}
