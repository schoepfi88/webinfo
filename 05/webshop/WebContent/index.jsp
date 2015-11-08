<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Webshop</title>
	<link href="css/bootstrap.min.css" rel="stylesheet"></link>
	<link href="css/webshop.css" rel="stylesheet"></link>
</head>
<body>
	<script src="js/jquery-2.1.4.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- mobile use -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Webshop</a>
			</div>
			
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Items</a></li>
					<li><a href="#">Categories</a></li>
				</ul>
				<form class="navbar-form navbar-right" role="search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go</button>
						</span>
					</div><!-- /input-group -->
				</form>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	
	<h1 class="h1">Latest Items</h1>	
	<br>
	<div class="row">
		<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
		</div>
		<div class="col-xs-10 col-md-10 col-sm-10 col-lg-10">
			<div class="panel panel-warning">
				<!-- Default panel contents -->
				<div class="panel-heading">Panel heading</div>
				<div class="panel-body">
					<p>...</p>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>