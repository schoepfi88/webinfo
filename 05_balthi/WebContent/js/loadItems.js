var app = angular.module("WebShop", []);

app.controller("ItemCtrl", function($scope, $http) {
	$http.get('http://localhost:8080/webshop/api/resource/item').
	success(function(data, status, headers, config) {
    	$scope.items = data;
    	$scope.oneSelected = false;
    	$scope.created = false;
	}).
	error(function(data, status, headers, config) {

	});
	
	$scope.getItem = function(id){
		$scope.id = $scope.items[id].id;
		$scope.url ="http://localhost:8080/webshop/api/resource/item/" + $scope.id + "/comment";
		$scope.oneSelected = true;
		$scope.items = [$scope.items[id]];
		$http.get($scope.url).
		success(function(data, status, headers, config) {
	    	$scope.comments = data;
	    	for (var i = 0; i < data.length; i++){	// add one hour for correct local time
	    		$scope.comments[i].createdAt = moment($scope.comments[i].createdAt).add(1, 'hours').format('YYYY-MM-DD HH:mm:ss');
	    	}
		}).
		error(function(data, status, headers, config) {

		});
	}
	
	$scope.createComment = function(comment){
		console.log(JSON.stringify(comment));
		console.log($scope.url);
		$http.post($scope.url, JSON.stringify(comment));
		comment.createdAt = moment().format('YYYY-MM-DD HH:mm:ss');
		$scope.comments.push(comment);
		$scope.comment = null;
		$scope.created = true;
	}
	
	$scope.deleteItem = function(index){
		var id = $scope.items[index].id;
		$http.delete('http://localhost:8080/webshop/api/resource/item/' + id);
	}
});