package webinfo;

import java.sql.Time;

public class Comment {

	private String username;
	private String content;
	private Time createdAt;

	
	
	public Comment(String username, String content, Time createdAt) {
		super();
		this.username = username;
		this.content = content;
		this.createdAt = createdAt;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getContent() {
		return content;
	}

	public void setContent(String content) {
		this.content = content;
	}

	public Time getCreatedAt() {
		return createdAt;
	}

	public void setCreatedAt(Time createdAt) {
		this.createdAt = createdAt;
	}

}
