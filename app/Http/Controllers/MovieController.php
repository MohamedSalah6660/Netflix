<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
class MovieController extends Controller
{
    
	public function index()
	{
		// It's about AutoComplete in search
		if (request()->ajax()) {
			
			$movies = Movie::whenSearch(request()->search)->get();

			return $movies;
		}

		$movies = Movie::whenCategory(request()->category_name)
		->whenSearch(request()->search)
		->whenFavorite(request()->favorite)
		->paginate(20);

		return view('layouts.movies.index', compact('movies'));
	}

	public function show(Movie $movie)
	{
		$related_movies = Movie::where('id' ,'!=' , $movie->id)

		->whereHas('categories', function($query) use ($movie){

			return $query->whereIn('category_id', $movie->categories->pluck('id')->toArray());

		})->get();

		return view('layouts.movies.show', compact('movie','related_movies'));
	}


	public function increment_views(Movie $movie)
	{
		$movie->increment('views');	
	}


	public function toggle_favorite(Movie $movie)
	{

	$movie->is_favored ? $movie->users()->detach(auth()->user()->id): $movie->users()->attach(auth()->user()->id);

		// if ($movie->is_favored) {
			
		// 	$movie->users()->attach(auth()->user()->id);

		// }else{
		// 	$movie->users()->detach(auth()->user()->id);

		// }
	}
}
