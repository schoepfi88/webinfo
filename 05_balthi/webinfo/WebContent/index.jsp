
<%@ page import="webinfo.User" language="java" contentType="text/html; charset=US-ASCII"
	pageEncoding="US-ASCII"%>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
	<%
		User user = User.getInstance();

		out.println("User :" + user.getUsername() + " Priv: " + user.getPrivilege());
	%>
	<h1>This is a Heading</h1>
	<p>This is a paragraph.</p>


	<form method="post" action="/webinfo/Login">
		Login Id: <input type="text" name="name" /> <br> Password: <input
			type="password" name="password" /> <br> <input type="submit"
			value="Login" />
	</form>

	<a href="/webinfo/register.jsp">Register</a>


</body>
</html>
