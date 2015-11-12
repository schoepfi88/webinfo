var app = angular.module("WebShop", []);

app.controller("ItemCtrl", function($scope, $http) {
	$http.get('http://localhost:8080/webshop/rest/item').
	success(function(data, status, headers, config) {
    	console.log(JSON.stringify(data));
    	$scope.items = data;
	}).
	error(function(data, status, headers, config) {

	});
});