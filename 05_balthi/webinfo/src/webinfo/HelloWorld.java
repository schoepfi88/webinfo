package webinfo;
// Import required java libraries
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

// Extend HttpServlet class
public class HelloWorld extends HttpServlet {
 
  private String message;

  public void init() throws ServletException
  {
      // Do required initialization
      message = "Hello World";
  }

  public void doGet(HttpServletRequest request,
                    HttpServletResponse response)
            throws ServletException, IOException
  {
      // Set response content type
      response.setContentType("text/html");

      // Actual logic goes here.
      PrintWriter out = response.getWriter();
      out.println("<h1>" + message + "</h1>");
  }
  
  
  protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
      // TODO Auto-generated constructor stub
		String id = request.getParameter("name");
		String pass = request.getParameter("password");
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		RequestDispatcher rd = null;
		request.setAttribute(id, "name");
		if(id.equals("name") && pass.equals("pass")){
			out.println("<b>Valid Login Info.</b><br>");
			rd = request.getRequestDispatcher("/HelloWorld");
			rd.forward(request, response);
		}
		else{
			out.println("<b>Invalid Login Info.</b><br>");
			rd = request.getRequestDispatcher("/HelloWorld");
			rd.include(request, response);
		}
		out.close();

	}




  
  
  public void destroy()
  {
      // do nothing.
  }
}