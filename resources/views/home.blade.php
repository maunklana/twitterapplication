@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/tweets') }}">
							<div class="form-group">
								<div class="col-md-12">
									<textarea class="form-control" id="tweetsatweets" name="tweetsatweets" rows="2" style="resize: none;" placeholder="Update status..."></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<p></p>
								</div>
								<div class="col-md-2 col-md-offset-1">
									<button type="submit" class="btn btn-primary">
										Update
									</button>
									 <input type="hidden" name="_token" value="{{ csrf_token() }}">
								</div>
							</div>
						</form>
						<!--
						You are logged in! {{ Auth::user()->name }} with email {{ Auth::user()->email }}
						
						<?php $loggedUser = Auth::user(); ?>
						
						<?=$loggedUser->id?>
						-->
					</div>
				</div>
				
				<div id="new-tweeets-alert" class="panel panel-default" style="border:none;">
					<div class="panel-body">
						<div class="col-md-12 text-center">
							<a id="show-new-tweets-btn" class="btn btn-info btn-block" href="#" role="button">New Tweets</a>
						</div>
					</div>
				</div>
				
				<div id="timelines" class="panel-body">
					
				</div>
				
				<div id="fountainG">
					<div id="fountainG_1" class="fountainG"></div>
					<div id="fountainG_2" class="fountainG"></div>
					<div id="fountainG_3" class="fountainG"></div>
					<div id="fountainG_4" class="fountainG"></div>
					<div id="fountainG_5" class="fountainG"></div>
					<div id="fountainG_6" class="fountainG"></div>
					<div id="fountainG_7" class="fountainG"></div>
					<div id="fountainG_8" class="fountainG"></div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
