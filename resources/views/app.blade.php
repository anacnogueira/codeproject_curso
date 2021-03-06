<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	@if(Config::get('app.debug'))
		<link rel="stylesheet" type="text/css" href="{{ asset('build/css/app.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('build/css/components.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('build/css/flaticon.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('build/css/font-awesome.css') }}">
	@else
		<link rel="stylesheet" type="text/css" href="{{ elixir('css/all.css') }}">
	@endif

	

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Welcome</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if(auth()->guest())
						@if(!Request::is('auth/login'))
							<li><a href="{{ url('/auth/login') }}">Login</a></li>
						@endif
						@if(!Request::is('auth/register'))
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@endif
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div ng-view>
		
	</div>

	<!-- Scripts -->
	@if(Config::get('app.debug'))
		<script src="{{ asset('build/js/vendor/jquery.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-route.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-resource.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-animate.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-messages.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/navbar.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/query-string.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/vendor/ng-file-upload.min.js') }}" type="text/javascript"></script>

	
		<script src="{{ asset('build/js/app.js') }}" type="text/javascript"></script>
		
		<!-- Controllers -->
		<script src="{{ asset('build/js/controllers/login.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/home.js') }}" type="text/javascript"></script>
		<!-- Clients -->
		<script src="{{ asset('build/js/controllers/client/clientList.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/client/clientNew.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/client/clientEdit.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/client/clientRemove.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/client/clientView.js') }}" type="text/javascript"></script>
		
		<!-- Projects -->
		<script src="{{ asset('build/js/controllers/project/projectList.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project/projectView.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project/projectNew.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project/projectEdit.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project/projectRemove.js') }}" type="text/javascript"></script>


		<!-- Projects Notes -->
		<script src="{{ asset('build/js/controllers/project-note/projectNoteList.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-note/projectNoteView.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-note/projectNoteNew.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-note/projectNoteEdit.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-note/projectNoteRemove.js') }}" type="text/javascript"></script>

		<!-- Projects Files -->
		<script src="{{ asset('build/js/controllers/project-file/projectFileList.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-file/projectFileView.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-file/projectFileNew.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-file/projectFileEdit.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-file/projectFileRemove.js') }}" type="text/javascript"></script>

		<!-- Projects Tasks -->
		<script src="{{ asset('build/js/controllers/project-task/projectTaskList.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-task/projectTaskView.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-task/projectTaskNew.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-task/projectTaskEdit.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/controllers/project-task/projectTaskRemove.js') }}" type="text/javascript"></script>

		<!-- Filters -->
		<script src="{{ asset('build/js/filters/date-br.js') }}" type="text/javascript"></script>

		<!-- Directives -->
		<script src="{{ asset('build/js/directives/projectFileDownload.js') }}" type="text/javascript"></script>

		<!-- Services -->
		<script src="{{ asset('build/js/services/url.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/services/client.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/services/project.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/services/projectNote.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/services/projectFile.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/services/projectTask.js') }}" type="text/javascript"></script>
		<script src="{{ asset('build/js/services/user.js') }}" type="text/javascript"></script>
	@else
		<script src="{{ elixir('js/all.js') }}" type="text/javascript"></script>
	@endif
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
