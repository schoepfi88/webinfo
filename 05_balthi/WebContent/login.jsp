<!DOCTYPE html>
<html>
<head>
	<meta charset="US-ASCII">
	<title>Login</title>
	<%@include file="navbar.jsp" %>
</head>
<body>
	<h1 class="h1">Login</h1>
	<div class="row">
		<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
		</div>
		<div class="col-xs-10 col-md-10 col-sm-10 col-lg-10">
			<form class="form-group" action="/webshop/Login" method="post">
				<label for="name">Username</label>
				<input class="form-control" name="name" />
				<br/>
				<label for="password">Password</label>
				<input class="form-control" name="password" type="password" />
				<br/>
				<input type="submit" value="Submit" />
			</form>
			<a href=/webshop/register.jsp>Register</a>
		</div>

	</div>
	



</body>
</html>