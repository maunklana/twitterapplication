<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use File;
use Hash;

class UserController extends Controller
{

    public function profile(){
		if (Auth::check()) {
			return view('profile', array('user' => Auth::user()) );
		}else{
			return redirect('/');
		}
    }
	
	public function update_profile(Request $request){
		if (Auth::check()) {
    	
			$user = Auth::user();
			
			// Handle the user upload of avatar
			if($request->hasFile('avatar')){
				// Delete old avatar
				if($user->avatar != 'default.jpg'){
					if (is_file(public_path('/uploads/avatars/' . $user->avatar))) {
						File::delete(public_path('/uploads/avatars/' . $user->avatar));
					}
				}
				
				$avatar = $request->file('avatar');
				$filename = md5(uniqid($user->id, true)).'_'.time() . '.' . $avatar->getClientOriginalExtension();
				Image::make($avatar)->fit(300)->save( public_path('/uploads/avatars/' . $filename ) );
				
				$user->avatar = $filename;
				
			}
			
			// Handle update user name
			if($request->has('name')){
				if($request->input('name') != $user->name){
					$name = $request->input('name');
					$user->name = $name;
				}
			}
			
			// Handle update user email
			if($request->has('email')){
				if($request->input('email') != $user->email){
					$email = $request->input('email');
					$user->email = $email;
				}
			}
			
			// Handle update user password
			if($request->has('password')){
				if($request->input('password') != $user->password){
					$password = $request->input('password');
					$user->password = Hash::make($password);
				}
			}
			
			$user->save();

			return view('profile', array('user' => Auth::user()) );
		}else{
			return redirect('/');
		}

    }
}
