<html>
	<head>
		<title>Bookmarks</title>
		<link rel="Shortcut Icon" href="/Includes/Images/1280357233_Red.ico" type="image/x-icon">
		<link rel="STYLESHEET" type="text/css" href="/Includes/CSS/main.css">
		<script type="text/javascript" src="/Includes/Scripts/jquery-1.4.2.min.js"></script>
		<script type="text/javascript">
		$(document).ready( function() {
			$.get("ListTemplate.php", function(result) { $("#listing").html(result);});
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
		});
		</script>
	</head>
	<body>
		<h1>List of Bookmarks stored for you</h1>
		<p><a href="http://www.horribad.com">Home</a></p>
		<div id="messages">
		</div>
		<ul>
			<li><a id="delete" href="#">Delete</a></li>
		</ul>
		<div id="listing">
		</div>
	</body>
</html>