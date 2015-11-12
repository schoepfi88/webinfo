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

@Path("/item")
public class Resource {
	private static String feedback = "";
	private static int feedbackTrigger = 0;
	private static int loadTrigger = 0;
	private static int errorTrigger = 0;
	@GET
	@Produces({MediaType.APPLICATION_JSON })
	public List<Item> getItems() throws ClassNotFoundException {
		Sqlite db = Sqlite.getInstance();
		ArrayList<Item> items = db.getItems();
		return items;
	}
	
	@GET
	@Produces({ MediaType.APPLICATION_JSON })
	@Path("{id}")
	public Item getItem(@PathParam("id") int id) throws ClassNotFoundException {
		Sqlite db = Sqlite.getInstance();
		Item item = db.getItem(id);
		return item;
	}
	
	@POST
	@Produces(MediaType.TEXT_HTML)
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	public void newItem(@FormParam("title") String title,
			@FormParam("description") String description,
			@FormParam("author") String author,
			@Context HttpServletResponse servletResponse) throws IOException, ClassNotFoundException {
		Item item = new Item();
		item.setDescription(description);
		item.setTitle(title);
		item.setAuthor(author);
		
		Sqlite.getInstance().createItem(item);
		servletResponse.sendRedirect("../create.jsp");
		Resource.setFeedback("Item successfully created");
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