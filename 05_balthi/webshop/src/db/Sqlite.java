package db;

import java.sql.*;
import java.util.ArrayList;
import models.Category;
import models.Item;
import org.sqlite.SQLiteJDBCLoader;

import org.sqlite.SQLiteDataSource;

public class Sqlite {
	private static Sqlite instance;
	private String dbPath = new DatabasePath().getPath();

	private Sqlite() {

	}

	public static Sqlite getInstance() {
		if (Sqlite.instance == null) {
			Sqlite.instance = new Sqlite();
		}
		return Sqlite.instance;
	}
	
	public ArrayList<Category> getCategories(){
		ArrayList<Category> categories = new ArrayList<>();
		try {
			Class.forName("org.sqlite.JDBC");
		} catch (ClassNotFoundException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		}
		try {
			// create a database connection
			Connection c = DriverManager
					.getConnection(dbPath);
			c.setAutoCommit(false);
			System.out.println("Opened database successfully");

			Statement stmt = c.createStatement();
			ResultSet rs = stmt.executeQuery("SELECT * FROM category;");
			while (rs.next()) {
				Category cat = new Category();
				cat.setId(rs.getInt("id"));
				cat.setName(rs.getString("name"));
				cat.setDescription(rs.getString("description"));
				categories.add(cat);
			}
			rs.close();
			stmt.close();
			c.close();
		} catch (Exception e) {
			System.err.println(e.getClass().getName() + ": " + e.getMessage());
			System.exit(0);
		}
		System.out.println("Operation done successfully");
		return categories;
	}
	
	public ArrayList<Item> getItems() throws ClassNotFoundException {
		ArrayList<Item> items = new ArrayList<>();
		Class.forName("org.sqlite.JDBC");
		try {
			// create a database connection
			Connection c = DriverManager
					.getConnection(dbPath);
			c.setAutoCommit(false);
			System.out.println("Opened database successfully");

			Statement stmt = c.createStatement();
			ResultSet rs = stmt.executeQuery("SELECT * FROM item;");
			while (rs.next()) {
				Item item = new Item();
				item.setId(rs.getInt("id"));
				item.setTitle(rs.getString("title1"));
				item.setAuthor(rs.getString("author"));
				item.setDescription(rs.getString("description"));
				item.setCreatedAt(rs.getString("created_at"));
				items.add(item);
			}

			rs.close();
			stmt.close();
			c.close();
		} catch (Exception e) {
			System.err.println(e.getClass().getName() + ": " + e.getMessage());
			System.exit(0);
		}
		System.out.println("Operation done successfully");

		return items;
	}

	public Item getItem(int id) throws ClassNotFoundException {

		Item item = new Item();
		Class.forName("org.sqlite.JDBC");
		try {
			// create a database connection
			Connection c = DriverManager
					.getConnection(dbPath);
			c.setAutoCommit(false);
			System.out.println("Opened database successfully");

			
			PreparedStatement pstmt = c.prepareStatement("SELECT * FROM item WHERE id like ?");
			
			pstmt.setInt(1, id);
			
			ResultSet rs = pstmt.executeQuery();
			item.setId(rs.getInt("id"));
			item.setTitle(rs.getString("title1"));
			item.setAuthor(rs.getString("author"));
			item.setDescription(rs.getString("description"));

			rs.close();
			pstmt.close();
			c.close();
		} catch (Exception e) {
			System.err.println(e.getClass().getName() + ": " + e.getMessage());
			System.exit(0);
		}
		System.out.println("Operation done successfully");
		return item;
	}

	public void createItem(Item item) throws ClassNotFoundException {
		Class.forName("org.sqlite.JDBC");
		try {
			boolean initialize = SQLiteJDBCLoader.initialize();
			SQLiteDataSource dataSource = new SQLiteDataSource();
			dataSource.setUrl(dbPath);
			Connection c = dataSource.getConnection();
			c.setAutoCommit(false);
			System.out.println("Opened database successfully");
			Statement stmt = c.createStatement();
			String sql = "INSERT INTO item (title1, description, author, category) ";
			String values = "VALUES ('" + item.getTitle() + "','" + item.getDescription() + "', '" + item.getAuthor() + "','" + item.getCategory()
					+ "');";
			stmt.executeUpdate(sql + values);
			stmt.close();
			c.commit();
			c.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

	}
	
	public void createCategory(Category cat) throws ClassNotFoundException {
		Class.forName("org.sqlite.JDBC");
		try {
			boolean initialize = SQLiteJDBCLoader.initialize();
			SQLiteDataSource dataSource = new SQLiteDataSource();
			dataSource.setUrl(dbPath);
			Connection c = dataSource.getConnection();
			c.setAutoCommit(false);
			System.out.println("Opened database successfully");
			Statement stmt = c.createStatement();
			String sql = "INSERT INTO category (name, description) ";
			String values = "VALUES ('" + cat.getName() + "','" + cat.getDescription() + "');";
			stmt.executeUpdate(sql + values);
			stmt.close();
			c.commit();
			c.close();
		} catch (Exception e) {
			e.printStackTrace();
		}

	}

	
}