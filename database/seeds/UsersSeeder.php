<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	$user = User::create([

    		'name' => 'super_admin',
    		'email' => 'super_admin@gmail.com',
    		'password' => bcrypt(123456),


    	]);

    	$user->attachRole('super_admin');
    }
}
