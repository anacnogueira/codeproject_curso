angular.module('app.controllers')
.controller('ProjectFileEditController', [
	'$scope', '$location', '$routeParams', 'ProjectFile', 
	function($scope, $location, $routeParams, ProjectFile){
	$scope.projectFile = projectFile.get({
		id: null,
		idFile: $routeParams.idFile
	});

	$scope.save = function() {
		if ($scope.form.valid) {
			ProjectFile.update({
				id: $routeParams.id, 
				idNote: $scope.projectFile.id
			}, $scope.projectNote, function (){
				$location.path('/project/' + $routeParams.id + '/files');
				
			});
		} 
	}

}]);