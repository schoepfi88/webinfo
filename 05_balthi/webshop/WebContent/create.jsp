<%@ page import="db.Sqlite, java.util.ArrayList, models.Category" language="java"
	contentType="text/html; charset=US-ASCII" pageEncoding="US-ASCII"%>
	
	<%
	ArrayList<Category> categories = Sqlite.getInstance().getCategories();
	System.out.println("categories size: "+ categories.size()+ "  "+categories.get(0).getName());
	
	%>

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
				<%for(int i = 0; i < categories.size();i++){
			
					out.println("<input type=\"radio\" name=\"category\" id=\"category"+categories.get(i).getId()+"\">"+categories.get(i).getName());
					out.println("<br>");
				}
				%>
				<input type="submit" value="Submit" />
			</form>
		
	
		</div>
	</div>
</body>
</html>