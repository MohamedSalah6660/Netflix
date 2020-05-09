<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
class Movie extends Model
{
	protected $appends = ['poster_path', 'image_path'];
	protected $fillable = ['name','path','description','image', 'poster', 'year', 'rating', 'percent'];

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'movie_category');
	}


	public function scopewhenSearch($query, $search)
	{
		return $query->when($search ,function($q) use($search){

			return $q->where('name', 'like', "%$search%")
					->orWhere('description', 'like', "%$search%")
					->orWhere('rating', 'like', "%$search%")
					->orWhere('year', 'like', "%$search%");

		});
	}

	public function scopeWhenCategory($query, $category)
	{
		return $query->when($category, function($q) use ($category){

			return $q->whereHas('categories' , function ($qu) use ($category){

				return $qu->whereIn('category_id', (array)$category)
						->orWhereIn('name', (array)$category);
			});
		});
	}


	public function getPosterPathAttribute()
	{
		return Storage::url('images/poster/'. $this->poster);
	}

	public function getImagePathAttribute()
	{
		return Storage::url('images/images/'.$this->image);
	}


}
