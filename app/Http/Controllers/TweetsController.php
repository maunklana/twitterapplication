<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;

class TweetsController extends Controller
{
    public function post_tweets(Request $request){
		if (Auth::check()) {
			$user = Auth::user();
			if($request->has('tweetsatweets')){
				$tweets = $request->input('tweetsatweets');
				DB::table('tweets')->insert(
					[
						'user_id' => $user->id,
						'tweet' => $tweets,
						"created_at" =>  \Carbon\Carbon::now(), # \Datetime()
						"updated_at" => \Carbon\Carbon::now(),  # \Datetime()
					]
				);
				$user->tweets = $tweets;
			}
			
		}
		
		return redirect('/');
	}
	
	 public function get_tweets(Request $request){
		if (Auth::check()) {
			if($request->has('latestid')){
				$getTweets = DB::table('tweets')->join('users', 'users.id', '=', 'tweets.user_id')->select( 'tweets.id', 'tweets.user_id as userid', 'users.name', 'users.avatar', 'tweets.tweet', 'tweets.created_at as timestamp')->where('tweets.id', '>', $request->input('latestid'))->orderBy('id', 'asc')->get();
				$tweets['totaltweets']=count($getTweets);
				$tweets['tweets'] = $tweets['tweets'] = collect($getTweets)->sortBy('id')->reverse()->toArray();
			}else{
				$user = Auth::user();
				$take=10;
				$skip=0;
				$page=0;
				if($request->has('page')){
					$page=$request->input('page');
					$skip=$take*$page;
				}
				$getTweets = DB::table('tweets')->join('users', 'users.id', '=', 'tweets.user_id')->select( 'tweets.id', 'tweets.user_id as userid', 'users.name', 'users.avatar', 'tweets.tweet', 'tweets.created_at as timestamp')->orderBy('id', 'desc')->skip($skip)->take($take)->get();
				$tweets['totaltweets']=count($getTweets);
				$tweets['tweets'] = collect($getTweets)->sortBy('id')->reverse()->toArray();
				$tweets['page']=$page;
			}
			return response()->json($tweets);
		}else{
			return redirect('/');
		}
	}
}
