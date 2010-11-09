<table>
	<tr>
		<th></th>
		<th><a onclick="Sort(this);" href="#">Title</a></th>
		<th><a onclick="Sort(this);" href="#">Date Added</a></th>
		<th><a onclick="Sort(this);" href="#">Last Modified</a></th>
		<th><a onclick="Sort(this);" href="#">Category</a></th>
		<th><a onclick="Sort(this);" href="#">Read</a></th>
	</tr>
	<?php
	foreach($resultArray as $row) {
		echo "<tr>";
		echo "<td><input type='checkbox' value='" . $row["_id"] . "' /></td>";
		echo "<td><a href='" .$row["link"] . "'>" . $row["title"] . "</a></td>";
		echo "<td>" . $row["add_date"] . "</td>";
		echo "<td>" . $row["last_modified"] . "</td>";
		echo "<td>" . $row["category"] . "</td>";
		echo "<td>" . $row["read"] . "</td>";
		echo "</tr>";
	}
	?>
</table>
