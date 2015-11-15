package resources;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.http.HttpServletResponse;
import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;

import db.Sqlite;
import models.Item;
import models.Category;

@Path("/resource")
public class Resource {
	private static String feedback = "";
	private static int feedbackTrigger = 0;
	private static int loadTrigger = 0;
	private static int errorTrigger = 0;
	@GET
	@Path("/item")
	@Produces({MediaType.APPLICATION_JSON })
	public List<Item> getItems() throws ClassNotFoundException {
		Sqlite db = Sqlite.getInstance();
		ArrayList<Item> items = db.getItems();
		return items;
	}
	
	@GET
	@Produces({ MediaType.APPLICATION_JSON })
	@Path("/item/{id}")
	public Item getItem(@PathParam("id") int id) throws ClassNotFoundException {
		Sqlite db = Sqlite.getInstance();
		Item item = db.getItem(id);
		return item;
	}
	
	@POST
	@Path("/item")
	@Produces(MediaType.TEXT_HTML)
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	public void newItem(@FormParam("title") String title,
			@FormParam("description") String description,
			@FormParam("author") String author,
			@FormParam("category") String category,
			@Context HttpServletResponse servletResponse) throws IOException, ClassNotFoundException {
		Item item = new Item();
		item.setDescription(description);
		item.setTitle(title);
		item.setAuthor(author);
		item.setCategory(category);
		Sqlite.getInstance().createItem(item);
		servletResponse.sendRedirect("../../create.jsp");
		Resource.setFeedback("Item successfully created");
	}
	
	@POST
	@Path("/category")
	@Produces(MediaType.TEXT_HTML)
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	public void newCat(@FormParam("name") String name,
			@FormParam("description") String description,
			@Context HttpServletResponse servletResponse) throws IOException, ClassNotFoundException {
		Category cat = new Category();
		cat.setDescription(description);
		cat.setName(name);
		
		Sqlite.getInstance().createCategory(cat);
		servletResponse.sendRedirect("../../createCategory.jsp");
		Resource.setFeedback("Category successfully created");
	}
	
	public static String getFeedback(){
		return feedback;
	}

	public static void setFeedback(String feed){
		feedback = feed;
		feedbackTrigger = loadTrigger +1;
	}
	
	public static int getFeedbackTrigger(){
		return feedbackTrigger;
	}
	
	public static int getLoadTrigger(){
		return loadTrigger;
	}
	
	public static void incLoadTrigger(){
		loadTrigger++;
	}
	
	public static void setError(String error){
		feedback = error;
		errorTrigger = loadTrigger +1;
	}
	
	public static int getErrorTrigger(){
		return errorTrigger;
	}
} 