<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
	protected $fillable = ['name'];


	public function movies()
	{
		return $this->belongsToMany(Movie::class, 'movie_category');
	}



	public function getNameAttribute($value)
	{
		return ucfirst($value);
	}

	public function scopewhenSearch($query, $search)
	{
		return $query->when($search ,function($q) use($search){

			return $q->where('name', 'like', "%$search%");

		});
	}

}


//Concept: Fat Model, Slim Controller