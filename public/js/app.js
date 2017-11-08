$(function() {
	$('#new-tweeets-alert').hide();
	var tweetspanelright='',tweetspanelleft='';
	$.get("template/tweets-panel-right.txt", function(d){
		tweetspanelright=d;
	});
	$.get("template/tweets-panel-left.txt", function(d){
		tweetspanelleft=d;
		console.log( "ready!" );
		loadTweets(0);
		
		(function getNewTweets() {
			var latesttweeetid=$("#timelines").find( "div" ).first().data("tweetid");
			if(latesttweeetid){
				$.getJSON("tweets?latestid="+latesttweeetid, function(result) {
					if(result['totaltweets']>0){
						$('#new-tweeets-alert').show();
						$('#show-new-tweets-btn').html(result['totaltweets']+" new tweets");
						document.title = "("+result['totaltweets']+") Twitter Aplication";
					}
				});
			}
			setTimeout(getNewTweets, 6000);
		})();
	});
	
	$("#show-new-tweets-btn").on("click", function(e){
		e.preventDefault();
		$('#new-tweeets-alert').hide();
		document.title = "Twitter Aplication";
		var latesttweeetid=$("#timelines").find( "div" ).first().data("tweetid");
		$.getJSON("tweets?latestid="+latesttweeetid, function(result) {
			if(result['totaltweets']>0){
				$.each(result['tweets'], function(tweets, tweet){
					var align ='left',posttweet='';
			
					var tempstrtweetspanelright=new String(tweetspanelright),tempstrtweetspanelleft=new String(tweetspanelleft),tweetspanel='',tweetspanelview='';
					
					if($("body").data("loggedinuserid")==tweet['userid']){
						tweetspanel=tempstrtweetspanelright;
					}else{
						tweetspanel=tempstrtweetspanelleft;
					}
					
					tweetspanelview=tweetspanel.replace('{TWEETSID}', tweet['id']).replace('{USERAVATAR}', tweet['avatar']).replace('{USERNAME}',tweet['name']).replace('{TWEETSTEXT}', tweet['tweet']).replace('{TWEETSTIMESTAMP}', tweet['timestamp']);
					
					$("#timelines").prepend(tweetspanelview);
				});
			}
		});
	});
	
	function loadTweets(pageNumber) {
		$("#fountainG").show();
		again=false;
		$ajaxError=true;
		var $getTweets=$.getJSON("tweets?page="+pageNumber, function(result){
			
			$.each(result['tweets'], function(tweets, tweet){
				var align ='left',posttweet='';
		
				var tempstrtweetspanelright=new String(tweetspanelright),tempstrtweetspanelleft=new String(tweetspanelleft),tweetspanel='',tweetspanelview='';
				
				if($("body").data("loggedinuserid")==tweet['userid']){
					tweetspanel=tempstrtweetspanelright;
				}else{
					tweetspanel=tempstrtweetspanelleft;
				}
				
				tweetspanelview=tweetspanel.replace('{TWEETSID}', tweet['id']).replace('{USERAVATAR}', tweet['avatar']).replace('{USERNAME}',tweet['name']).replace('{TWEETSTEXT}', tweet['tweet']).replace('{TWEETSTIMESTAMP}', tweet['timestamp']);

				$("#timelines").append(tweetspanelview);
			});
			
			if(!result){
				$("#timelines").append('<hr /><p class="text-center">An Error Occurred... Please Reload.</p><hr />');
			}else if(result['totaltweets']<10){
				again=false;
				$("#timelines").append('<hr /><p class="text-center">No more Tweets...</p><hr />');
			}else{
				again=true;
			}
			$ajaxError=false;
			$("#fountainG").hide();
		});
		setTimeout(function(){
			if($ajaxError){
				$("#timelines").append('<hr /><p class="text-center">An Error Occurred... Please Reload.</p><hr />');
				$("#fountainG").hide();
			}
		}, 9000);
		return false;
	}
	var count = 1, again=true;
	$(window).bind('scroll', function(e) {
		if  ($(this).scrollTop()+100 >= $(document).height() - $(window).height()){
			if(again){
				loadTweets(count);
				count++;
				console.log(again);
			}
			console.log('scroll down');
		}
		console.log($(this).scrollTop()+'scroll down'+($(document).height() - $(window).height()));
	});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#show-avatar-image').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$(".image-avatar-upload").each(function(){
		$(this).on("click", function(e){
			e.preventDefault();
			$("#avatar-file-upload").click();
		});
	});

	$("#avatar-file-upload").change(function(){
		readURL(this);
	});
});