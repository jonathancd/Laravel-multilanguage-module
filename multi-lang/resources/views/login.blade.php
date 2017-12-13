<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta author="Jonathan Cuotto">

    <title>Athmos - Multilenguage admin</title>
	
    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ url('assets') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets') }}/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ url('assets') }}/css/form-elements.css">
   	<link rel="stylesheet" href="{{ url('templates') }}/css/login.css">


	<link href="{{ url('templates') }}/css/login.css" rel="stylesheet">


	<!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('assets') }}/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('assets') }}/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('assets') }}/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ url('assets') }}/ico/apple-touch-icon-57-precomposed.png">


</head>
<body>
	 <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
 
                @if (session('status'))
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Bootstrap</strong> Login Form</h1>
                            <div class="description alert alert-dark">
                                <p>
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="{{url('/login')}}" method="post" class="login-form">
			                    	{{ csrf_field() }}
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="email" placeholder="Email..." class="form-username form-control" id="form-username">

			                        	<span class="text-danger" style="font-size: 13px;">{{ $errors->first('email') }}</span>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">

			                        	<span class="text-danger" style="font-size: 13px;">{{ $errors->first('password') }}</span>
			                        </div>
			                        <button type="submit" class="btn">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="{{ url('assets') }}/js/jquery-1.11.1.min.js"></script>
        <script src="{{ url('assets') }}/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ url('assets') }}/js/jquery.backstretch.min.js"></script>
        <script src="{{ url('assets') }}/js/scripts.js"></script>
        
</body>
</html>