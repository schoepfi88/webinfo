function loadProducts() {
	
	$.get('loadProductServlet', {
		"tmp" : "allNames"
	}, function(resp) { // on sucess
		// We need 2 methods here due to the different ways of
		// handling a JSON object.

		printProducts(resp);

	}).fail(function() { // on failure
		alert("Request failed.");
	});

}

function printProducts(json) {

	// var item = JSON.parse(json);
	// First empty the <div> completely and add a title.
	$("#allProducts").empty();

	// Then add every band name contained in the list.
	$.each(json, function(i, item) {
		$("#allProducts").append(
				"<div id=\"productDiv" + item.id + "\"><ul><li>" + item.name
						+ "</li><li>id: " + item.id
						+ "</li><li><button id=\"productButton" + item.id
						+ "\" type=\"button\" onclick=\"loadMore(" + item.id
						+ ")\">More</button></li></ul></div>");
	});
};

function loadMore(id) {
	$.get('loadMoreServlet', {
		"id" : id
	}, function(resp) { // on sucess
		// We need 2 methods here due to the different ways of
		// handling a JSON object.

		printMore(resp, id);

	}).fail(function() { // on failure
		alert("Request failed.");
	});

};

function printMore(json, id) {
	

	$("#productDiv" + id).empty().append(
			"<ul><li>" + json.title + "</li><li>id: " + json.id
					+ "</li><li>Description:" + json.description
					+ "</li><li>Author:" + json.author + "</li></ul>");// item.description

};

