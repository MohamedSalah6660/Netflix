<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
use Image;
use Storage;
use App\Category;
use App\Jobs\StreamMovie;
class MovieController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:read_movies')->only(['index']);
        $this->middleware('permission:create_movies')->only(['create', 'store']);
        $this->middleware('permission:update_movies')->only(['edit', 'update']);
        $this->middleware('permission:delete_movies')->only(['destroy']);
    }



    public function index()
    {
    	$categories = Category::all();
    	$movies = Movie::whenSearch(request()->search)
    	->whenCategory(request()->category)
    	->with('categories')->paginate(5);
    	return view('dashboard.movies.index', compact('movies', 'categories'));
    }

    public function create()
    {
    	$categories = Category::all();
    	$movie = Movie::create([]);

    	return view('dashboard.movies.create', compact('movie','categories'));
    }

    public function store(Request $request)
    {
    
    	$movie = Movie::findOrFail($request->movie_id);

    	$movie->update([

    		'name'=>$request->name,
    		'path'=>$request->file('movie')->store('movies'),
    	]);

    	//I need to endcode the movie in the background thriw job

    	$this->dispatch(new StreamMovie($movie));

    	return $movie;

		// toastr()->success('Movie Added Successfully');

  //   	return redirect()->route('dashboard.movies.index');


    }

    public function show(Movie $movie)
    {
    	return $movie;
    }



    public function edit(Movie $movie)
    {
    	$categories = Category::all();

    	return view('dashboard.movies.edit', compact('movie','categories'));
    }



    public function update(Request $request, Movie $movie)
    {
		if($request->type == 'publish')
		{

				$request->validate([

    		'name'=>'required|unique:movies,name,'.$movie->id,
    		'description' => 'required',
    		'image' => 'required|image',
    		'poster' => 'required|image',
    		'rating' => 'required',
    		'year'=>'required',
    		'categories'=>'required|array|min:1'

    	]);


		}else{

			$request->validate([

    		'name'=>'required|unique:movies,name,'.$movie->id,
    		'description' => 'required',
    		'image' => 'sometimes|nullable|image',
    		'poster' => 'sometimes|nullable|image',
    		'rating' => 'required',
    		'year'=>'required',
    		'categories'=>'required|array|min:1'

    	]);

		}

		$request_data = $request->except(['poster', 'image']);

		if ($request->image) {

			$this->remove_previous('image' , $movie);
			
			$image = Image::make($request->image)
			->resize(255,378)->encode('jpg');

			Storage::disk('local')->put('public/images/images/' . $request->image->hashName(),
			(string)$image , 'public' );
			//(srting) $poster : it's called make casting to $poster
			$request_data['image'] = $request->image->hashName();

		}

		if ($request->poster) {
		
			$this->remove_previous('poster' , $movie);

			$poster = Image::make($request->poster)
			->resize(255,378)->encode('jpg');

			Storage::disk('local')->put('public/images/poster/' . $request->poster->hashName(),
			(string)$poster , 'public' );
			//(srting) $poster : it's called make casting to $poster
			$request_data['poster'] = $request->poster->hashName();

		}

    	$movie->update($request_data);

    	$movie->categories()->sync($request->categories);
		toastr()->success('Movie Updated Successfully');

    	return redirect()->route('dashboard.movies.index');
    }

    public function destroy(Movie $movie)
    {
		Storage::disk('local')->delete('public/images/images/' . $movie->image);
		Storage::disk('local')->delete('public/images/poster/' . $movie->poster);
		Storage::disk('local')->delete($movie->path);
		Storage::disk('local')->deleteDirectory('public/movies/' . $movie->id);

    	
    	$movie->delete();

		toastr()->warning('Movie Deleted Successfully');

    	return redirect()->route('dashboard.movies.index');

    }
    public function remove_previous($image_type, $movie)
    {
    	if($image_type == 'poster')
    	{
    		if ($movie->poster != null) {
    			
    			Storage::disk('local')->delete('public/images/poster/' . $movie->poster);
    		}
    	}else{

    			if ($movie->image != null) {
    			
    			Storage::disk('local')->delete('public/images/' . $movie->image);
    		}
    	}



    }

}
