<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Twitter Application</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css" rel="stylesheet">
	{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>

<body id="app-layout"@if (!Auth::guest()) data-loggedinuserid="{{ Auth::user()->id }}"@endif>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
				<a class="navbar-brand" href="{{ url('/') }}">
                    Twitter Application
                </a>
				@if (!Auth::guest())
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				@endif
                <!-- Branding Image -->
            </div>
			@if (!Auth::guest())
            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
								<img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/profile') }}">Profile</a></li>
                                <li><a href="{{ url('/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
			@endif
        </div>
    </nav>

    @yield('content')
	<p id="debugP"></p>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
	//;(function(){
	//	var baseLogFunction = console.log;
	//	console.log = function(){
	//		baseLogFunction.apply(console, arguments);
    //
	//		var args = Array.prototype.slice.call(arguments);
	//		for(var i=0;i<args.length;i++){
	//			var node = createLogNode(args[i]);
	//			document.querySelector("#debugP").appendChild(node);
	//		}
    //
	//	}
    //
	//	function createLogNode(message){
	//		var node = document.createElement("div");
	//		var textNode = document.createTextNode(message);
	//		node.appendChild(textNode);
	//		return node;
	//	}
	//})();
	</script>
	<script src="{{ asset('/js/app.js') }}"></script>   
	{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
