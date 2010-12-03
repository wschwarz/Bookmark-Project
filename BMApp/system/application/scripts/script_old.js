$(document).ready( function() {
	$.get("ListTemplate.php", {sort: "sup", test: "test"},function(result) { $("#listing").html(result);});
	$("#delete").click( function() {
		$("input:checked").each(function() {
			$.ajax({
				type: "POST",
				url: 'Methods.php',
				data: "method=delete&id=" + $(this).val(),
				contentType: 'application/x-www-form-urlencoded',
				success: function(result) {
					$("#messages").append(result + " was deleted.<br />");
					$.get("ListTemplate.php", function(result) { $("#listing").html(result);});
				},
				error: function(result){
					for(key in result) {
						$("#messages").append(key + ": " + result[key] + "<br />");
					}
				}
			});
		});
	});
	$(".Sorting").click(function() {
		var direction = -1;
		$.get("ListTemplate.php", { sort: "true", field: $(this).text(), direction: changeDirection(direction)}, function(result) { $("#listing").html(result);});
	});
	function changeDirection(direction) {
		if (direction == 1)
			return -1;
		else
			return 1;
	}
});