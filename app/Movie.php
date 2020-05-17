<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
class Movie extends Model
{
	protected $appends = ['poster_path', 'image_path','is_favored'];

	protected $fillable = ['name','path','description','image', 'poster', 'year', 'rating', 'percent'];

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'movie_category');
	}

	public function users()
    {
        return $this->belongsToMany(User::class, 'user_movie');
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


	public function scopeWhenFavorite($query, $favorite)
	{
		return $query->when($favorite, function($q){

			return $q->whereHas('users', function($qu){

				return $qu->where('user_id', auth()->user()->id);
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
	public function getIsFavoredAttribute()
	{
		if (auth()->user()) {
			
			return (bool)$this->users()->where('user_id', auth()->user()->id)->count();
		}

		return false;
	}


}
