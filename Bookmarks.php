<?php
include 'dbAccess.php';
$db = new db();
$resultArray = $db->getAll();
?>
<html>
	<head>
		<title>Bookmarks</title>
		<link rel="Shortcut Icon" href="/Includes/Images/1280357233_Red.ico" type="image/x-icon">
		<link rel="STYLESHEET" type="text/css" href="/Includes/CSS/main.css">
		<script type="text/javascript" src="/Includes/Scripts/jquery-1.4.2.min.js"></script>
		<script type="text/javascript">
		$(document).ready( function() {
			$("#delete").click( function() {
				var ids = $("input:checked").each(function() {
					alert($(this).val());
				});
				/*$.ajax({
					type: "POST",
					url: 'dbAccess.php',
					data: "method=delete&id=" + $("#delete").val(),
					contentType: 'application/x-www-form-urlencoded'
					success: function(result) {
					}
				})*/
			});
		});
		</script>
	</head>
	<body>
		<h1>List of Bookmarks stored for you</h1>
		<p><a href="http://www.horribad.com">Home</a></p>
		<ul>
			<li><a id="delete" href="#">Delete</a></li>
		</ul>
		<table>
			<tr>
				<th></th>
				<th>Title</th>
				<th>Url</th>
				<th>Date Added</th>
				<th>Last Modified</th>
				<th>Category</th>
				<th>Read</th>
			</tr>
			<?php
			foreach($resultArray as $row) {
				echo "<tr id='" . $row["_id"] . "'>";
				echo "<td><input type='checkbox' value='" . $row["_id"] . "' /></td>";
				echo "<td>" . $row["title"] . "</td>";
				echo "<td>" . $row["link"] . "</td>";
				echo "<td>" . $row["add_date"] . "</td>";
				echo "<td>" . $row["last_modified"] . "</td>";
				echo "<td>" . $row["category"] . "</td>";
				echo "<td>" . $row["read"] . "</td>";
				echo "</tr>";
			}
			?>
		</table>
	</body>
</html>