package resources;

import javax.ws.rs.ApplicationPath;
import org.glassfish.jersey.jackson.JacksonFeature;
import org.glassfish.jersey.server.ResourceConfig;
@ApplicationPath(value = "/rest")
public class Application extends ResourceConfig{
	public Application(){
		packages("resources");
		register(JacksonFeature.class);
	}
}
