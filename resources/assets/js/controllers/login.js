angular.module('app.controllers')
.controller('loginController', ['$scope', function($scope){
	$scope.user = {
		username: '',
		password: ''
	};

	$scope.login = function(){

	};

}]);