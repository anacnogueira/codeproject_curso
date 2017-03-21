angular.module('app.controllers')
.controller('ProjectNoteViewController', [
	'$scope', '$location','$routeParams', 'ProjectNote', 
	function($scope,$location,$routeParams,ProjectNote){
        $scope.projectNote = ProjectNote.query({
            id: $routeParams.id,
            idNote: $routeParams.idNote
        },function(){

        },function(error){
            
            
        });



}]);