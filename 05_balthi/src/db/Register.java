package db;


import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;

import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Register
 */
@WebServlet("/Register")
public class Register extends HttpServlet {
	private static final long serialVersionUID = 1L;
    private String dbPath = new DatabasePath().getPath();
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Register() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String usrn = request.getParameter("name");
		String pass = request.getParameter("password");
		Connection connection = null;
		//Statement stmt = null;
		try {
			Class.forName("org.sqlite.JDBC");

			connection = DriverManager.getConnection(dbPath);
			
			//stmt = connection.createStatement();
		      //String sql = "INSERT INTO user (user_name, password, privilege) " +
		        //           "VALUES ('teest', 'teeeeeeest', 32 );"; 
		      //stmt.executeUpdate(sql);
			
			PreparedStatement pstmt = connection
					.prepareStatement("INSERT INTO user (user_name, password, privilege) VALUES (?, ?, ?)");
			pstmt.setString(1, usrn);
			pstmt.setString(2, pass);
			pstmt.setInt(3, 7);

			int ctrl = pstmt.executeUpdate();
			
			if (ctrl > 0) {
				response.getWriter().append("<script language=\"javascript\">window.alert('User Registration Successfull');window.location=\"index.jsp\";</script>");
			} else {
				response.getWriter().append("<script language=\"javascript\">window.alert('ERROR\nUser Registration UNSuccessfull');window.location=\"index.jsp\";</script>");
			}
		} catch (ClassNotFoundException | SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} finally {
			try {
				if (connection != null)
					connection.close();
			} catch (SQLException e) {
				// connection close failed.
				System.err.println(e);
			}
		}
		
	}

}