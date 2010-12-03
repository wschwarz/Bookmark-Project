$(document).ready( function() {
	$.get("Bookmarks/LoadBookmarks/", function(result) { $("#listing").html(result);});
	$("#delete").click( function() {
		if (confirm('Are you sure you want to delete?')) {
			$("input:checked").each(function() {
				$.ajax({
					type: "POST",
					url: "Bookmarks/RemoveEntry",
					data: "id=" + $(this).val(),
					contentType: 'application/x-www-form-urlencoded',
					success: function(result) {
						$("#messages").append(result + " was deleted.<br />");
						
					},
					error: function(result){
						for(key in result) {
							$("#messages").append(key + ": " + result[key] + "<br />");
						}
					}
				});
			});
		}
		$.get("Bookmarks/LoadBookmarks", function(result) { $("#listing").html(result);});
	});
	$("#SearchField").change( function() {
		$.ajax({
			type: "POST",
			url: "Bookmarks/Query",
			data: "query=" + $(this).val(),
			contentType: 'application/x-www-form-urlencoded',
			success: function(result) {
				$("#listing").html(result);
			}
		});
	});
	$("button, input:submit, a").button();
});
function Link(direction) {
	if (direction == 'forward')
	{
		$.get("Bookmarks/LoadBookmarks", {pageDirection: "forward"}, function(result) { $("#listing").html(result);});
	}
}
function ReadClicked(readObj) {
	$.ajax({
		type: "POST",
		url: "Bookmarks/SetRead",
		data: "id=" + readObj,
		contentType: 'application/x-www-form-urlencoded',
		success: function(result) {
			$("#messages").append(result + "<br />");
		}
	})
	setTimeout("$.get('Bookmarks/LoadBookmarks', function(result) { $('#listing').html(result);})", 1000);
}
function Sort(fieldobject) {
	var direction = 1;
	if (readCookie("direction") == null)
	{
		document.cookie = "direction=1";	
	}
	else {
		direction = readCookie("direction");
		document.cookie = "direction=" + changeDirection(direction);
	}
	$.get("Bookmarks/SortBookmarks", {field: fieldobject.text.toLowerCase(), direction: direction}, function(result) { $("#listing").html(result);});
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function changeDirection(direction) {
	if (direction == 1)
		return -1;
	else
		return 1;
}