angular.module('app.controllers')
.controller('ProjectFileListController', [
	'$scope', '$routeParams', 'ProjectNote', 
	function($scope, $routeParams, ProjectFile){
	$scope.projectFiles = ProjectFile.query({id: $routeParams.id});

}]);