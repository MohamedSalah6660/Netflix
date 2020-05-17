<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Category;
use App\Role;
class WelcomeController extends Controller
{
    
	public function index()
	{
		$user_count =User::whereHas('roles', function($q){
    		$q->where('name', 'admin');
			})->count();
		$cat_count = Category::count();
		$movie_count = Movie::where('percent',100)->count();


		return view('dashboard.welcome', compact('user_count', 'cat_count', 'movie_count'));
	}




}
