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
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import db.Sqlite;
import models.Item;

@Path("/item")
public class Resource {
	// This method is called if XMLis request
	@GET
	@Produces({ MediaType.APPLICATION_XML, MediaType.APPLICATION_JSON })
	public Item getItem() {
		Sqlite db = Sqlite.getInstance();
		Item item = db.getItem();
		return item;
	}
	
	@GET
	@Produces({ MediaType.APPLICATION_XML, MediaType.APPLICATION_JSON })
	@Path("/items")
	public List<Item> getItems() {
		Sqlite db = Sqlite.getInstance();
		ArrayList<Item> items = db.getItems();
		return items;
	}
	
	@POST
	@Produces(MediaType.TEXT_HTML)
	@Consumes(MediaType.APPLICATION_FORM_URLENCODED)
	public void newItem(@FormParam("title") String title,
			@FormParam("description") String description,
			@FormParam("author") String author,
			@Context HttpServletResponse servletResponse) throws IOException {
		Item item = new Item();
		item.setDescription(description);
		item.setTitle(title);
		item.setAuthor(author);
		
		
		Sqlite.getInstance().createItem(item);

		//servletResponse.sendRedirect("../index.html");
		//servletResponse.setStatus(200);
	}
} 