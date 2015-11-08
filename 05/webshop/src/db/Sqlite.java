package db;

import java.sql.*;
import java.util.ArrayList;
import models.Item;
import org.sqlite.SQLiteJDBCLoader;
import org.sqlite.SQLiteDataSource;

public class Sqlite {
	private static Sqlite instance;
	private Sqlite () {
	    
	}
	
	public static Sqlite getInstance () {
		if (Sqlite.instance == null) {
			Sqlite.instance = new Sqlite ();
		}
		return Sqlite.instance;
	}
	public ArrayList<Item> getItems(){
		ArrayList<Item> items = new ArrayList<>();
		try {
			// create a database connection
			Connection c = DriverManager.getConnection("jdbc:sqlite:../../workspace/webshop/src/db/shop.db");
	    	c.setAutoCommit(false);
	    	System.out.println("Opened database successfully");

	    	Statement stmt = c.createStatement();
	    	ResultSet rs = stmt.executeQuery( "SELECT * FROM item;" );
	    	while ( rs.next() ) {
	    		Item item = new Item();
	    		item.setId(rs.getInt("id"));
				item.setTitle(rs.getString("title1"));
				item.setAuthor(rs.getString("author"));
				items.add(item);
	    	}
	    	
			rs.close();
			stmt.close();
			c.close();
	    } catch ( Exception e ) {
	    	System.err.println( e.getClass().getName() + ": " + e.getMessage() );
	    	System.exit(0);
	    }
	    System.out.println("Operation done successfully");
	    
	    
	    return items;
	}
	
	public Item getItem(){
		Item item = new Item();
		try {
			// create a database connection
			Connection c = DriverManager.getConnection("jdbc:sqlite:../../workspace/webshop/src/db/shop.db");
	    	c.setAutoCommit(false);
	    	System.out.println("Opened database successfully");

	    	Statement stmt = c.createStatement();
	    	ResultSet rs = stmt.executeQuery( "SELECT * FROM item;" );
			item.setId(rs.getInt("id"));
			item.setTitle(rs.getString("title1"));
			item.setAuthor(rs.getString("author"));
			rs.close();
			stmt.close();
			c.close();
	    } catch ( Exception e ) {
	    	System.err.println( e.getClass().getName() + ": " + e.getMessage() );
	    	System.exit(0);
	    }
	    System.out.println("Operation done successfully");
	    return item;
	}
	
	public void createItem(Item item){
		try {
			boolean initialize = SQLiteJDBCLoader.initialize();
			SQLiteDataSource dataSource = new SQLiteDataSource();
	        dataSource.setUrl("jdbc:sqlite:../../workspace/webshop/src/db/shop.db");
	    	Connection c = dataSource.getConnection();
	    	c.setAutoCommit(false);
	    	System.out.println("Opened database successfully");
	    	Statement stmt = c.createStatement();
			String sql = "INSERT INTO item (title1, description, author) ";
			String values = "VALUES ('" + item.getTitle() + "','" + item.getDescription() + "', '" +item.getAuthor() + "');";
			stmt.executeUpdate(sql+values);
			stmt.close();
			c.commit();
			c.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
        
	}
}
