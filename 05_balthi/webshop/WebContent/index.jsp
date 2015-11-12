<%@ page import="models.User" language="java"
	contentType="text/html; charset=US-ASCII" pageEncoding="US-ASCII"%>

<!DOCTYPE html>
<html>
	<head>
		<title>Webshop</title>
		<%@include file="navbar.jsp" %>
		<% if(Resource.getLoadTrigger() == Resource.getFeedbackTrigger()) {%>
			<div class="row">
				<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
				</div>
				<div class="col-xs-10 col-md-10 col-sm-10 col-lg-10">
					<div id="feedback" class="alert alert-success" role="alert"><% out.println(Resource.getFeedback()); %></div>
				</div>
			</div>
		<% } %>
	</head>
	<h1 class="h1">Latest Items</h1>
	<body ng-app="WebShop">
	  <div ng-controller="ItemCtrl">
	  	<div class="row" ng-repeat="item in items">
	  		<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
				</div>
			<div class="col-xs-10 col-md-10 col-sm-10 col-lg-10">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{item.title}}
						<span class="author">
							{{item.author}} - {{item.createdAt}}
						</span>
					</div>
					<div class="panel-body">
						{{item.description}}
						<span class="price">
							{{item.price}} $
						</span>
					</div>
				</div>
			</div>
	  	</div>
	</body>
</html>