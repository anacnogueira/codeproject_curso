angular.module('app.controllers')
.controller('ProjectTaskEditController', [
	'$scope',  '$routeParams', '$location', 'ProjectTask', 'appConfig'
	function($scope,  $routeParams, $location, ProjectTask, appConfig){
		$scope.projectTask = ProjectTask.get({
			id: $routeParams.id,
			idNote: $routeParams.idTask
		});

		$scope.status = appConfig.projectTask.status;

		$scope.start_date = {
			status: {
				opened: false
			}
		}

		$scope.due_date = {
			status: {
				opened: false
			}
		}

		$scope.openStartDatePicker = function($event) {
			$scope.start_date.status.opened = true;
		}

		$scope.openDueDatePicker = function($event) {
			$scopedue_date.status.opened = true;
		}


		$scope.save = function() {
			if ($scope.form.valid) {
				ProjectTask.update({
					id: $routeParams.id, 
					idTask: $scope.projectTask.id
				}, $scope.projectTask, function (){
					$location.path('/project/' + $routeParams.id + '/tasks');				
				});
			} 
		}

	}]);