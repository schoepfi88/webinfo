function loadProducts() {
	
	$.get('products', 
	function(resp) { // on sucess
		printProducts(resp);
	}).fail(function() { // on failure
		alert("Request failed.");
	});

}

function printProducts(json) {

	$("#allProducts").empty();
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
	$.get('more', {
		"id" : id
	}, function(resp) { // on sucess
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

