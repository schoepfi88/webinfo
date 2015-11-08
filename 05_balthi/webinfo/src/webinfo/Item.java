package webinfo;

import java.sql.Time;
import java.util.ArrayList;

public class Item {
	
	private String title;
	private
	
	
	String description;
	private Time createdAt;
	private String username;
	private ArrayList<Comment> comments;
	
	public Item(String title, String description, Time createdAt, String username) {
		super();
		this.title = title;
		this.description = description;
		this.createdAt = createdAt;
		this.username = username;
		
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public Time getCreatedAt() {
		return createdAt;
	}

	public void setCreatedAt(Time createdAt) {
		this.createdAt = createdAt;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public ArrayList<Comment> getComments() {
		return comments;
	}

	public void addComment(Comment comments) {
		this.comments.add(comments);
	}
	
	
	
	
	



}
