<!DOCTYPE html>
<html>
<head>
	<title>Create Item</title>
	<%@include file="navbar.jsp" %>
</head>
<body>
	<h1 class="h1"> Create Item </h1>
	<div class="row">
		<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
		</div>
		<div class="col-xs-10 col-md-10 col-sm-10 col-lg-10">
			<form class="form-group" action="../webshop/rest/item" method="POST">
				<label for="author">Author</label>
				<input class="form-control" name="author" />
				<br/>
				<label for="title">Title</label>
				<input class="form-control" name="title" />
				<br/>
				<label for="area">Description</label>
				<textarea class="form-control" name="area" rows="3"></textarea>
				<br/>
				<input type="submit" value="Submit" />
			</form>
		</div>
	</div>
</body>
</html>