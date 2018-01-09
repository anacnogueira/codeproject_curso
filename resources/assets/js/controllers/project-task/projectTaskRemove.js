angular.module('app.controllers')
.controller('ProjectTaskRemoveController', [
	'$scope', '$location', '$routeParams','ProjectTask', 
	function($scope, $location,$routeParams, ProjectTask){
		$scope.ProjectTask = ProjectTask.get({
		id: $routeParams.id,
		idNote: $routeParams.idTask
	});

	$scope.remove = function(){
		$scope.ProjectTask.$delete({
				id: $routeParams.id, 
				idTask: $scope.projectTask.id
			}).then(function(){
			$location.path('/project/' + $routeParams.id + '/tasks')
		});			
	}

}]);