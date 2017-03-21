angular.module('app.controllers')
.controller('ProjectNoteRemoveController', [
	'$scope', '$routeParams', 'ProjectNote', 
	function($scope, $routeParams, ProjectNote){
		$scope.projectNotes = ProjectNote.query({id: $routeParams.id});

}]);