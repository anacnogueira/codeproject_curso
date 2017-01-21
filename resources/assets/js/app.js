var app = angular.module('app',['ngRoute','angular-oauth2','app.controllers', 'app.services']);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.services',['ngResource']);


app.provider('appConfig', function(){
	var config = {
		baseUrl: 'http://projects-api.dev',

	};

	return {
		config: config,
		$get: function(){
			return config;
		}
	}
});

app.config([
	'$routeProvider', 'OAuthProvider', 'OAuthTokenProvider','appConfigProvider',
	function($routeProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
	$routeProvider
		.when('/login',{
			templateUrl: 'build/views/login.html',
			controller: 'LoginController'
		})
		.when('/home',{
			templateUrl: 'build/views/home.html',
			controller: 'HomeController'
		})
		// Clients
		.when('/clients',{
			templateUrl: 'build/views/client/list.html',
			controller: 'ClientListController'
		})
		.when('/clients/:id',{
			templateUrl: 'build/views/client/view.html',
			controller: 'ClientViewController'
		})
		.when('/clients/new',{
			templateUrl: 'build/views/client/new.html',
			controller: 'ClientNewController'
		})
		.when('/clients/:id/edit',{
			templateUrl: 'build/views/client/edit.html',
			controller: 'ClientEditController'
		})
		.when('/clients/:id/remove',{
			templateUrl: 'build/views/client/remove.html',
			controller: 'ClientRemoveController'
		})

		// Project Notes
		.when('/project/:id/notes',{
			templateUrl: 'build/views/note/list.html',
			controller: 'NoteListController'
		})
		.when('/project/:id/notes/:idNote',{
			templateUrl: 'build/views/note/view.html',
			controller: 'NoteViewController'
		})
		.when('/project/:id/notes/new',{
			templateUrl: 'build/views/note/new.html',
			controller: 'NoteNewController'
		})
		.when('/project/:id/notes/:idNote/edit',{
			templateUrl: 'build/views/note/edit.html',
			controller: 'NoteEditController'
		})
		.when('/project/:id/notes/:idNote/remove',{
			templateUrl: 'build/views/note/remove.html',
			controller: 'NoteRemoveController'
		});

	OAuthProvider.configure({
		baseUrl: appConfigProvider.config.baseUrl,
		clientId: 'appid1',
		clientSecret: 'secret',
		grantPath: 'oauth/access_token'
	});

	OAuthTokenProvider.configure({
		name: 'token',
		options: {
			secure: false
		}
	});	
}]);

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
      // Ignore `invalid_grant` error - should be catched on `LoginController`.
      if ('invalid_grant' === rejection.data.error) {
        return;
      }

      // Refresh token when a `invalid_token` error occurs.
      if ('invalid_token' === rejection.data.error) {
        return OAuth.getRefreshToken();
      }

      // Redirect to `/login` with the `error_reason`.
      return $window.location.href = '/login?error_reason=' + rejection.data.error;
    });
}]);