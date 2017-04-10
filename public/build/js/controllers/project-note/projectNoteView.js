angular.module('app.controllers')
.controller('ProjectNoteViewController', [
	'$scope', '$location','$routeParams', 'ProjectNote', 
	function($scope, $location, $routeParams, ProjectNote){
	$scope.projectNote = ProjectNote.get({
		id: $routeParams.id,
		idNote: $routeParams.idNote
	});


}]);